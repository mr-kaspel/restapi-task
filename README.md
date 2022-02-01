# restapi-task
Movie Library REST API

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
</p>

## Database Model
<p align="center">
<img src="/dev/images/database_model.png" alt="Database model">
</p>

## Documentation

**GET** `/api/movies` get all values.
**GET** `/api/movies/{id}` {id} - element number. Get element by id.
Sort by movie title `/api/movies?sort=asc`
Filtering by genre and actor `/api/movies?field_actors=actor&filter_genr=genr`

**POST** `/api/movies?name=name_film&genres=genres&actors=actor1,actor2,actor3...` add a movie with parameters to the database.
**PUT** `/api/movies/{id}?name=name_film&genres=genres&actors=actor1,actor2,actor3...` {id} - element number. Data update.
**DELETE** `/api/movies/{id}` {id} - element number. Delete element by id.
