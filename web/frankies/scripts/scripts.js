'use strict' 
 
 // Get a list of vehicles in inventory based on the classificationID 
 let typeList = document.querySelector("#typeList"); 
 typeList.addEventListener("change", function () { 
  let type_id = typeList.value; 
  console.log(`type id is: ${type_id}`); 
  let classIDURL = "/frankies/animals/index.php?action=getAnimalTypes&type_id=" + type_id; 
  fetch(classIDURL) 
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) { 
   buildAnimalList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message) 
  }) 
 })

 // Build inventory items into HTML table components and inject into DOM 
function buildAnimalList(data) { 
    let animalDisplay = document.getElementById("animalDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Animal</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
     dataTable += `<tr><td>${element.animal_name}</td>`; 
     dataTable += `<td><a href='/frankies/animals?action=mod&id=${element.animal_id}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/frankies/animals?action=del&id=${element.animal_id}' title='Click to delete'>Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    animalDisplay.innerHTML = dataTable; 
   }








function filterAnimals(event){
/*     let filter = event.target.value;
    console.log(filter);
    if (filter === 0){
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log("made it here");
                document.getElementById("animal-display").innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.open("GET", "/frankies/animals/index.http?action=filterData&&type_id =" + filter, true);
    xmlhttp.send(); */

    

 
}