package com.csis4495.aiorestaurants.db

import java.util.*

data class EmployeeJson (
    var employeeId : Int, //This is double in atlas, test if it has any errors.
    var firstName: String,
    var lastName:  String,
    var userCategory: Double,
    var username: String,
    var password: String,
)

data class GoalJson(
    var date: String, //TODO: Try to test Date format as well.
    var goal: Double,
    var sales: Double
)

data class RestaurantJson(
    var name: String,
    var cashFund: Double
)

data class UserCategoryJson(
    var categoryId: Int,
    var category: String
)

data class DishJson(
    var dishId: Int,
    var name: String,
    var category: String,
    var price: Double,
    var ingredients: List<IngredientJson>

)

data class IngredientJson(
    var name: String,
    var qty: Double
)

