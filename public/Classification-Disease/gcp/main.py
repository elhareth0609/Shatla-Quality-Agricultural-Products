from google.cloud import storage
from PIL import Image
import tensorflow as tf
import numpy as np



from fastapi import FastAPI, File, UploadFile
from fastapi.middleware.cors import CORSMiddleware
from io import BytesIO

import uvicorn

app = FastAPI()

origins = [
    "http://localhost",
    "http://localhost:3000"
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


model = tf.keras.models.load_model("../models/potatoes1.h5")
class_names = ["Early Blight", "Late Blight", "Healthy"]

def read_file_as_image(data) -> np.ndarray:
   image = np.array(Image.open(BytesIO(data)))
   return image

@app.post("/predict")
async def predict(
    file: UploadFile = File(...)
):

    image = read_file_as_image(await file.read())

    # image = np.array(Image.open(image).convert("RGB").resize((256, 256))) # image resizing

    image = image/255 # normalize the image in 0 to 1 range

    img_array = tf.expand_dims(image, 0)
    predictions = model.predict(img_array)

    print("Predictions:",predictions)

    predicted_class = class_names[np.argmax(predictions[0])]
    confidence = round(100 * (np.max(predictions[0])), 2)

    # set CORS headers
    headers = {
        'Access-Control-Allow-Origin': '*'
    }

    response = {
        "class": predicted_class,
        "confidence": confidence
    }

    return (response, 200, headers)


if __name__ == "__main__":
    uvicorn.run(app, host='localhost', port=8000)

