package com.csis4495.aiorestaurants.db

import androidx.lifecycle.LiveData
import androidx.room.Dao
import androidx.room.Insert
import androidx.room.OnConflictStrategy
import androidx.room.Query
import com.csis4495.aiorestaurants.db.roomEntities.*

@Dao
interface AioDao {

    //InsertAll queries
    @Insert(onConflict = OnConflictStrategy.REPLACE)
    fun insertAllDishes(dishList : List<DishEntity>)

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    fun insertAllEmployees(employeeList : List<EmployeeEntity>)

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    fun insertAllGoals(goalList : List<GoalEntity>)

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    fun insertAllRestaurants(restaurantList : List<RestaurantEntity>)

    @Insert(onConflict = OnConflictStrategy.REPLACE)
    fun insertAllUserCategories(userCategoryList : List<UserCategoryEntity>)

    //Insert single value queries
    @Insert(onConflict = OnConflictStrategy.REPLACE)
    fun insertGoal(newGoal : GoalEntity)

    //GetAll queries
    @Query("SELECT * FROM dish")
    fun getAllDishes() : LiveData<List<DishEntity>>

    @Query("SELECT * FROM employee")
    fun getAllEmployees() : LiveData<List<EmployeeEntity>>

    @Query("SELECT * FROM goal")
    fun getAllGoals() : LiveData<List<GoalEntity>>

    @Query("SELECT * FROM restaurant")
    fun getAllRestaurants() : LiveData<List<RestaurantEntity>>

    @Query("SELECT * FROM userCategory")
    fun getAllUserCategories() : LiveData<List<UserCategoryEntity>>

    //GetByAtt queries
    @Query("SELECT * FROM dish WHERE name = :name")
    fun getDishByName(name : String) : DishEntity

    @Query("SELECT * FROM employee WHERE username = :username")
    fun getEmployeeByUsername(username : String) : EmployeeEntity

    @Query("SELECT * FROM goal WHERE date = :date")
    fun getGoalByDate(date : String) : GoalEntity

    @Query("SELECT * FROM userCategory WHERE categoryId = :id")
    fun getUserCategoryById(id : Int) : UserCategoryEntity




}