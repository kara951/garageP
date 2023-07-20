<?php

if ($car["image"] === null) {
    $imagePath =  "assets/images/default-car.jpg";
    //_ASSETS_IMAGES_FOLDER_ . "assets/images/default-car.jpg";
} else {
    $imagePath =  "uploads/cars/" . $car['image'];
    //_CARS_IMAGES_FOLDER_ . $car["image"];
}
?>



<div class="box">
    <img src="<?= $imagePath ?>" alt="<?= htmlentities($car["title"]) ?> ">
    <h3 class="card-title"><?= htmlentities($car["title"]) ?></h3>
    <h3><?= htmlentities($car["modele"]) ?></h3>
    <p><?= htmlentities($car["annee"]) ?></p>
    <span><?= htmlentities($car["kilometre"]) ?></span>
    <p><?= htmlentities($car["vitesse"]) ?></p>
    <p><?= htmlentities($car["carburant"]) ?></p>
    <span><?= htmlentities($car["prix"]) ?><br></span>
    <a href="actualite.php?id=<?= $car["id"] ?>">Détails<i class='bx bx-right-arrow-alt'></i></a>
</div>



<script>
    let dataArray;

    async function getUsers() {
        try {
            const response = await fetch(
                "https://randomuser.me/api/?nat=fr&results=50"
            );

            const {
                results
            } = await response.json();
            orderList(results);
            dataArray = results;
            createUserList(dataArray);
        } catch (error) {
            console.log(error);
        }
    }
    getUsers();

    function orderList(data) {
        data.sort((a, b) => {
            if (a.name.last < b.name.last) {
                return -1;
            } else if (a.name.last > b.name.last) {
                return 1;
            } else {
                return 0;
            }
        });
    }

    const tableResults = document.querySelector(".table-results");

    function createUserList(array) {
        array.forEach(user => {
            const listItem = document.createElement("li");
            listItem.className = "table-item";

            listItem.innerHTML = `
      <p class="main-info">
        <img
          src=${user.picture.thumbnail}
          alt="avatar picture"
        />
        <span>${user.name.last} ${user.name.first}</span>
      </p>
      <p class="email">${user.email}</p>
      <p class="phone">${user.phone}</p>

    `;
            tableResults.appendChild(listItem);
        });
    }

    const searchInput = document.querySelector("#search");

    searchInput.addEventListener("input", filterData)

    function filterData(e) {
        tableResults.textContent = "";

        const searchedString = e.target.value.toLowerCase().replace(/\s/g, "");

        const filteredArr = dataArray.filter(userData => searchForOccurences(userData))

        function searchForOccurences(userData) {
            const searchTypes = {
                firstname: userData.name.first.toLowerCase(),
                lastName: userData.name.last.toLowerCase(),
                firstAndLast: `${userData.name.first + userData.name.last}`.toLowerCase(),
                lastAndFirst: `${userData.name.last + userData.name.first}`.toLowerCase(),
            }
            for (const prop in searchTypes) {
                if (searchTypes[prop].includes(searchedString)) {
                    return true;
                }
            }
        }

        createUserList(filteredArr)
    }
</script>