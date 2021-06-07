from flask import Flask, render_template,  request, escape
from flask_pymongo import PyMongo
from dotenv import load_dotenv
import os
import pytest

load_dotenv()

app = Flask(__name__)
app.config["MONGO_URI"] = os.getenv('MONGO_URI') # replace the URI with your own connection
mongo = PyMongo(app)

# @app.route('/')
# def init():                            
#     return '<h1> {} </h1>'.format(__name__)

def getProducts():
    products = list()

    productQuery = mongo.db.productInventory.find({})

    for p in productQuery:
        products.append(p['productName'])

    return products

def getDishes():
    return mongo.db.dish.find({})


def mainTest():

    products = getProducts()

    for ingredient in getDishes()['ingredients']:
        assert products.count(ingredient['name']) == 1

        

# def testProductMatch(productList, dish):
#     for ingredient in dish['ingredients']:
#         return productList.count(ingredient['name']) == 1



# print(getProducts())
# print(getProducts().count("Beef"))
# dishes = list(getDishes())
# print(dishes[0]['ingredients'][6]['name'])

# if __name__ == '__main__':
#     app.run(host='0.0.0.0',debug=True)

