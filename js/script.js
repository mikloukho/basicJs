/* Задание на урок:

1) Автоматизировать вопросы пользователю про фильмы при помощи цикла

2) Сделать так, чтобы пользователь не мог оставить ответ в виде пустой строки,
отменить ответ или ввести название фильма длинее, чем 50 символов. Если это происходит - 
возвращаем пользователя к вопросам опять

3) При помощи условий проверить  personalMovieDB.count, и если он меньше 10 - вывести сообщение
"Просмотрено довольно мало фильмов", если от 10 до 30 - "Вы классический зритель", а если больше - 
"Вы киноман". А если не подошло ни к одному варианту - "Произошла ошибка"

4) Потренироваться и переписать цикл еще двумя способами*/

"use strict";


let personalMovieDB = {
    count: null,
    movies: {},
    actors: {},
    genres: [],
    privat: false
};

function start() {
    personalMovieDB.count = prompt('Сколько фильмов вы уже посмотрели?');
    if (personalMovieDB.count == '' || personalMovieDB.count == null || isNaN(personalMovieDB.count)) {
        start();
    }
}

start();

function rememberMyFilms() {
    for (let i = 0; i < 2; i++) {
        const nameOfFilms = prompt('Один из последних просмотренных фильмов?', '');
        const raitingOfFilms = prompt('На сколько оцените его?', '');
        if (nameOfFilms == '' || raitingOfFilms == '' || nameOfFilms == null || raitingOfFilms == null) {
            i--;
        } else {
            personalMovieDB.movies[nameOfFilms] = raitingOfFilms;
        }

    }
}

rememberMyFilms();

function writeYourGenres() {
    for (let i = 0; i < 3; i++) {
        personalMovieDB.genres[i] = prompt(`Ваш любимый жанр под номером ${i + 1}`, '');
    }
}

writeYourGenres();

function detectPersonalLevel() {
    if (personalMovieDB.count <= 10) {
        console.log('Просмотрено довольно мало фильмов');
    } else if (10 < personalMovieDB.count && personalMovieDB.count <= 30) {
        console.log('Вы классический зритель');
    } else if (personalMovieDB.count > 30) {
        console.log('Вы киноман');
    } else {
        console.log('Произошла ошибка');
    }
}

detectPersonalLevel();

function showMyDB() {
    if (!personalMovieDB.privat) {
        console.log(personalMovieDB);
    }
}

showMyDB();