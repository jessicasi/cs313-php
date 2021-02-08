function filterAnimals(event){
    let filter = event.target.value;
    if (filter == 0){
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("animal-display").innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.open("GET", "/frankies/animals/index.http?action=filterData&&type_id =" + filter, true);

 
}