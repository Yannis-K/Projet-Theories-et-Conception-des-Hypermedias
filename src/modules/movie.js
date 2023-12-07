import { tmdbApi } from "../js/const.js";

// https://www.themoviedb.org/talk/5cf2e5d8c3a3685e7c240424?language=be-BY

const getMovieById = async (movieId) => {
  try {
    const apiUrl = `https://api.themoviedb.org/3/movie/${movieId}?api_key=${tmdbApi.apiKey}&language=fr`;

    const response = await fetch(apiUrl);

    if (!response.ok) {
      throw new Error("Erreur lors de la récupération des données du film");
    }

    const data = await response.json();
    // Extracting the poster path
    const posterPath = data.poster_path;

    // Creating the full image URL
    const imageUrl = `https://image.tmdb.org/t/p/w500${posterPath}`;

    // Adding the image URL to the data object
    data.imageUrl = imageUrl;
    return data;
  } catch (error) {
    throw new Error(`Une erreur s'est produite : ${error.message}`);
  }
};

const getAllMovies = async (genreId = null, numberOfMovies = 10) => {
  try {
    // Construct the base API URL for discovering movies
    let apiUrl = `https://api.themoviedb.org/3/discover/movie?api_key=${tmdbApi.apiKey}&language=fr`;

    // Add genre parameter if provided
    if (genreId !== null) {
      apiUrl += `&with_genres=${genreId}`;
    }

    // Add the number of movies parameter
    apiUrl += `&page=1&include_adult=false&sort_by=popularity.desc&vote_average.gte=0&vote_count.gte=0&with_watch_monetization_types=flatrate&with_original_language=fr&with_watch_providers=streaming&with_runtime.gte=0&with_runtime.lte=400&with_release_type=3&with_original_language=en&include_image_language=fr&with_decades=2010`;

    // Make the API request
    const response = await fetch(apiUrl);

    // Handle unsuccessful responses
    if (!response.ok) {
      throw new Error("Erreur lors de la récupération des données des films");
    }

    // Parse the JSON response
    const data = await response.json();

    // Extract relevant information from the response
    const movies = data.results.slice(0, numberOfMovies).map((movie) => {
      // Extracting the poster path
      const posterPath = movie.poster_path;
      // Creating the full image URL
      const imageUrl = `https://image.tmdb.org/t/p/w500${posterPath}`;
      // Adding the image URL to the movie object
      movie.imageUrl = imageUrl;
      return movie;
    });

    // Return the array of movies
    return movies;
  } catch (error) {
    throw new Error(`Une erreur s'est produite : ${error.message}`);
  }
};

export { getMovieById, getAllMovies };
