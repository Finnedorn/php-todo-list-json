<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/axios@1.1.2/dist/axios.min.js"></script>
    <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
    <div id="app">
        <div class="container bg-primary p-5 my-4 rounded-4 ">
            <header class="text-center">
                <div class="d-flex justify-content-center align-items-center py-3">
                    <h1 class="text-light">
                        To Do List
                    </h1>
                </div>
                <div class="my-3 d-flex justify-content-center">
                    <input type="text" class="form-control w-25" v-model="newTask" @keyup.enter="">
                    <button class="btn btn-success mx-2" @click="">
                        <i class="fa-solid fa-plus text-light "></i>
                    </button>
                </div>
            </header>
            <main>
                <div class="card p-5 rounded-4">
                    <ul class="list-group list-group-flush rounded-4" v-if="todoList.length > 0">
                        <li class="list-group-item list-group-item-action d-flex justify-content-between" 
                        v-for="(el, index) in todoList" :key="todoList.index">
                            <div class="list-el">
                                {{el.task}}
                            </div>
                            <i class="fa-solid fa-x list-el">
                            </i>
                        </li>
                    </ul>
                    <div v-else class="text-center py-3">
                        <h3>
                            Nessuna Task!
                        </h3>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src='https://unpkg.com/vue@3/dist/vue.global.js'></script>
    <script src="js/script.js"></script>
</body>
