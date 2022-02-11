// the link to your model provided by Teachable Machine export panel
const URL = "https://teachablemachine.withgoogle.com/models/M4rkNsP3c/";

let model, webcam, labelContainer, maxPredictions;


// Load the image model and setup the webcam
async function init() {


    const modelURL = URL + "model.json";
    const metadataURL = URL + "metadata.json";

    // load the model and metadata
    model = await tmImage.load(modelURL, metadataURL);
    maxPredictions = model.getTotalClasses();

    // Convenience function to setup a webcam
    const flip = true; // whether to flip the webcam
    webcam = new tmImage.Webcam(350, 350, flip); // width, height, flip
    await webcam.setup(); // request access to the webcam
    await webcam.play();
    window.requestAnimationFrame(loop);
    
    document.getElementById("start_button").classList.add('removed');

    // append elements to the DOM
    document.getElementById("webcam-container").appendChild(webcam.canvas);
    labelContainer = document.getElementById("label-container");
      for (let i = 0; i < maxPredictions; i++) { // and class labels
         labelContainer.appendChild(document.createElement("div"));
    }

}

async function loop() {
    webcam.update(); // update the webcam frame
    await predict();
    window.requestAnimationFrame(loop);
}


// run the webcam image through the image model
async function predict() {
    // predict can take in an image, video or canvas html element
    const prediction = await model.predict(webcam.canvas);


    for (let i = 0; i < maxPredictions; i++) {
        pred_class = prediction[i].className
        pred_score = prediction[i].probability.toFixed(2)

        action(pred_class, pred_score)
        
        const classPrediction = pred_class + ": " + pred_score;
        console.log(classPrediction)

       

        labelContainer.childNodes[i].innerHTML = classPrediction;
    }
}



var audio = new Audio('GunakanMasker.mp3');
var first_time = true;  
    
function play(){
    console.log(audio.ended);
    
    if (first_time){
        audio.play();
        first_time = false;
    }
    if (audio.ended){
        // console.log('New Started');
        audio.play();
    }
    else{
        // console.log('Old Audio is Playing');
        }
    
    }   

function action(pred_class, pred_score){
    if (pred_class=='Tidak Menggunakan Masker' && pred_score>0.5){
        play();
    }}



function ambilGambar() {

}



function takeSnapshot() {
    // buat elemen img
    var img = document.createElement('img');
    var context;

    // ambil ukuran video
    var width = webcam.offsetWidth
            , height = webcam.offsetHeight;

    // buat elemen canvas
    canvas = document.createElement('canvas');
    canvas.width = width;
    canvas.height = height;

    // ambil gambar dari video dan masukan 
    // ke dalam canvas
    context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, width, height);

    // render hasil dari canvas ke elemen img
    img.src = canvas.toDataURL('image/png');
    document.body.appendChild(img);
}

function takeSnapshot(){
    document.getElementById("webcam-container").getContext("2d").drawImage(webcam, 0, 0, 350, 350);
    var imageData = canvas.toDataURL("image/jpeg");

    console.log(imageData);
}

// function action(pred_class, pred_score){
//    if (pred_class=='Tidak Menggunakan Masker' && pred_score>0.5){
 //       takeSnapshot();
  //  }









//buat elemen img
//var img = document.createElement('img');
//var context;

//ambil  ukuran video
//var width = webcam.offsetWidth , height = webcam.offsetHeight;

//buat elemen canvas
//canvas = document.createElement('canvas');
//canvas.width = width;
//canvas.height = height;

//ambil gambar dari video dan masukan ke dlm canvas
//context = canvas.getContext('2d');
//context.drawImage(webcam, 0, 0, width, height);

//render hasil dari kanvas ke elemen img
//img.src = canvas.toDataURL('image/png');
//document.body.appendChild(img);
