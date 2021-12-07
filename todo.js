var todo = {
    data: [], // holder for todo list array

    // Rechargement des données après une MAJ
    load: function() {
        // Initiamisation du stockage local : https://blog.logrocket.com/localstorage-javascript-complete-guide/#whereislocalstoragestored
        //https://blog.logrocket.com/localstorage-javascript-complete-guide/
        // https://dev.to/vladimirschneider/simple-to-do-list-using-localstorage-29on
        if (localStorage.list == undefined) {
            localStorage.list = "[]";
        }

        // Chagrment de la précédedente session
        // index dans le tableau
        // [0] = Task
        // [1] = Status : 0 en cours, 1 terminée, 2 abandonnée
        todo.data = JSON.parse(localStorage.list);
        todo.list();
    },

    // SAuvegarde des données dans le localstorage
    save: function() {

        localStorage.list = JSON.stringify(todo.data);
        todo.list();
    },

    // Annulation
    list: function() {
        // Vidage de la liste
        let container = document.getElementById("todo-list");
        //LET container = document.getElementById("todo-list");

        container.innerHTML = "";

        // Construction de la liste
        if (todo.data.length > 0) {
            let row = "",
                el = "";
            for (var key in todo.data) {

                // élément ligne
                row = document.createElement("div");
                row.classList.add("todo-row");
                row.dataset.id = key;

                // élément texte (el)
                el = document.createElement("div");
                el.classList.add("todo-item");
                if (todo.data[key][1] == 1) {
                    el.classList.add("done");
                }
                if (todo.data[key][1] == 2) {
                    el.classList.add("cx");
                }
                el.innerHTML = todo.data[key][0];
                row.appendChild(el);

                // Cancel button
                el = document.createElement("input");
                el.setAttribute("type", "button");
                el.value = "\u2716";
                el.classList.add("todo-cx");
                el.addEventListener("click", function() {
                    todo.status(this, 2);
                });
                row.appendChild(el);

                // OK button
                el = document.createElement("input");
                el.setAttribute("type", "button");
                el.value = "\u2714";
                el.classList.add("todo-ok");
                el.addEventListener("click", function() {
                    todo.status(this, 1);
                });
                row.appendChild(el);

                // Ajout de la ligne à la liste (sous forme de DIV)
                container.appendChild(row);
            }
        }
    },

    // ajout d'un élément à la TODO
    add: function() {

        let item = document.getElementById("todo-item");
        todo.data.push([item.value, 0]);
        item.value = "";
        todo.save();
    },

    // Mise à jour du statut 
    status: function(el, stat) {
        todo.data[el.parentElement.dataset.id][1] = stat;
        todo.save();
    },

    // supression élements
    del: function(type) {
        if (confirm("Delete tasks?")) {
            // tous
            if (type == 0) {
                todo.data = [];
                todo.save();
            }

            // terminées
            else {
                todo.data = todo.data.filter(row => row[1] == 0);
                todo.save();
            }
        }
    }
};

// démarrage de la page, gestion des élémenents
window.addEventListener("load", function() {
    document.getElementById("todo-delall").addEventListener("click", function() {
        todo.del(0);
    });
    document.getElementById("todo-delcom").addEventListener("click", function() {
        todo.del(1);
    });
    document.getElementById("todo-add").addEventListener("submit", function(evt) {
        evt.preventDefault();
        todo.add();
    });
    todo.load();
});