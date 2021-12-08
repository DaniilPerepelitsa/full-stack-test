
**Instruction.**

**After launching the project:**


You may create .env file

You may specify database settings in your .env file.

**Run:**

composer install

npm install

**Run migrations:**

php artisan migrate

**Run seeder to import data from feed.json and fill tables with information from the file:**

php artisan db:seed


**How it works:**

go to url "/"

You can see list of all categories. 

When you click on a category, you will be taken to a list of all posts in this category.

Immediately you will see a search box where you can enter a word or phrase and click search.

After clicking this button, all the results that best match your search criteria will appear on page.

You can also click on the post and go to view.

Also, all posts results returned with pagination for convenience of use.


**What was done:**
I made filtering by category.

A search was made for posts in the category.

Made indexes in the posts table for FULLTEXT search.

I used FULLTEXT search it works faster than LIKE. A like is needed if you need to find an exact match of a sentence or word
Used the library JsonMachine for convenient and fast work with json files.

Api requests are created from the frontend to backend. Backend makes queries to the database and returns response to frontend.

I made the whole design primitive, I didn't bother with it, as it was said in the assignment. I focused more on functionality.





