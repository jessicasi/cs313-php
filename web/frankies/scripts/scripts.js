'use strict' 
 
 // Get a list of vehicles in inventory based on the classificationID 
 let classificationList = document.querySelector("#classificationList"); 
 classificationList.addEventListener("change", function () { 
  let classificationID = classificationList.value; 
  console.log(`classificationID is: ${classificationID}`); 
  let classIDURL = "/phpmotors/vehicles/index.php?action=getInventoryItems&classificationID=" + classificationID; 
  fetch(classIDURL) 
  .then(function (response) { 
   if (response.ok) { 
    return response.json(); 
   } 
   throw Error("Network response was not OK"); 
  }) 
  .then(function (data) { 
   console.log(data); 
   buildInventoryList(data); 
  }) 
  .catch(function (error) { 
   console.log('There was a problem: ', error.message) 
  }) 
 })

 // Build inventory items into HTML table components and inject into DOM 
function buildInventoryList(data) { 
    let inventoryDisplay = document.getElementById("inventoryDisplay"); 
    // Set up the table labels 
    let dataTable = '<thead>'; 
    dataTable += '<tr><th>Vehicle Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>'; 
    dataTable += '</thead>'; 
    // Set up the table body 
    dataTable += '<tbody>'; 
    // Iterate over all vehicles in the array and put each in a row 
    data.forEach(function (element) { 
     console.log(element.invId + ", " + element.invModel); 
     dataTable += `<tr><td>${element.invMake} ${element.invModel}</td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=mod&id=${element.invId}' title='Click to modify'>Modify</a></td>`; 
     dataTable += `<td><a href='/phpmotors/vehicles?action=del&id=${element.invId}' title='Click to delete'>Delete</a></td></tr>`; 
    }) 
    dataTable += '</tbody>'; 
    // Display the contents in the Vehicle Management view 
    inventoryDisplay.innerHTML = dataTable; 
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