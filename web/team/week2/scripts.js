document.getElementById("clickbtn").addEventListener("click", alertFunction);
document.getElementById("colorbtn").addEventListener("click", colorFunction);

function alertFunction() {
    alert("Clicked!");
}

function colorFunction() {
    let color = document.getElementById("colorinput").value;

    document.getElementById("custom").style.backgroundColor = color;

}