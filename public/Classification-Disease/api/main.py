from fastapi import FastAPI, File, UploadFile
from fastapi.middleware.cors import CORSMiddleware
from io import BytesIO
from PIL import Image

import uvicorn
import numpy as np
import tensorflow as tf

app = FastAPI()

origins = [
    "http://localhost",
    "http://localhost:8000"
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

modelPotatoes = tf.keras.models.load_model("../models/potatoes1.h5")
classesPotatoes = ["Early Blight", "Late Blight", "Healthy"]

modelTomatos = tf.keras.models.load_model("../models/3")
classesTomatos = ['Tomato_Bacterial_spot',
               'Tomato_Early_blight',
               'Tomato_Late_blight',
               'Tomato_Leaf_Mold',
               'Tomato_Septoria_leaf_spot',
               'Tomato_Spider_mites_Two_spotted_spider_mite',
               'Tomato__Target_Spot',
               'Tomato__Tomato_YellowLeaf__Curl_Virus',
               'Tomato__Tomato_mosaic_virus',
               'Tomato_healthy']

# https://github.com/Gary0417/tomato_disease_classification
# https://github.com/Hamagistral/Potato-Disease-Classification

@app.post("/predict/Potatoes")
async def predict(file: UploadFile):

    imagePotatoes = np.array(Image.open(BytesIO(await file.read())).convert("RGB").resize((256, 256)))  # converting image to numpy array

    imagePotatoes = imagePotatoes/255 # normalize the image in 0 to 1 range

    img_batch = np.expand_dims(imagePotatoes, 0)  # creating image batch for prediction

    # image prediction
    predictions = modelPotatoes.predict(img_batch)

    predicted_class = classesPotatoes[np.argmax(predictions[0])]  # getting predicted class
    confidence = round(100 * (np.max(predictions[0])), 2)

    return {
        'class': predicted_class,
        'confidence': confidence
    }

@app.post("/predict/Tomato")
async def predict(file: UploadFile):

    imageTomatos = np.array(Image.open(BytesIO(await file.read())))  # converting image to numpy array

    img_batch = np.expand_dims(imageTomatos, 0)

    # image prediction
    predictions = modelTomatos.predict(img_batch)

    predicted_class = classesTomatos[np.argmax(predictions[0])]  # getting predicted class
    confidence = round(100 * (np.max(predictions[0])), 2)  # getting prediction confidence

    return {
        'class': predicted_class,
        'confidence': confidence
    }


if __name__ == "__main__":
    uvicorn.run(app, host="localhost", port=8080)
