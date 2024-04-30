var count = 0;
document.getElementById("myButton").onclick = function () {
    count++;
    if (count % 2 == 0) { 
        document.getElemetnById("myButton").innerHTML = ""
    } else {
        var img = document.createElement("img");
        img.src = "https://avatars.dzeninfra.ru/get-zen_doc/9884063/pub_64c454b7c42721583863b18a_64c45b9b15168172517d4faf/scale_1200";
        document.getElementById("myButton").appendChild(img);
    }
}
