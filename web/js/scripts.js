function dropDown() {
    let hobby = document.getElementById("hobbyList");
    if (hobby.style.display){
        hobby.style.display = ((hobby.style.display!='none') ? 'none' : 'block');
        }
        else {hobby.style.display='block'}
       
}