
let option = document.getElementById("selectSubject");
let td = document.getElementsByTagName("td")[0];

option.addEventListener('change', function(){
    if(option != undefined && option.value != "Select"){
        let xhr = new XMLHttpRequest(); // Using XMLHttpRequest

        xhr.open("POST", "get_data.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var valueToSend = option.value;
        
        xhr.send("class=" + encodeURIComponent(valueToSend));
       
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let response = JSON.parse(xhr.responseText);

                td.innerHTML = "";

                response.forEach((data) => {
                    let tr = document.createElement('tr');
                    tr.textContent = data.subject;
                    td.appendChild(tr);
                })


            } else if (xhr.readyState === 4 && xhr.status !== 200) {
                console.error("AJAX error:", xhr.statusText);
            }
        };
       
        xhr.send();
    }
})
              