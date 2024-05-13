function addTextarea(listName) {
    let list = document.getElementById(listName);

    let textarea = document.createElement("textarea");
    textarea.className = "form-control";
    textarea.setAttribute("name", listName + list.childElementCount);
    textarea.setAttribute("id", listName + list.childElementCount);

    let div = document.createElement("div");
    div.className = "form-floating mb-3";

    let label = document.createElement("label");
    label.setAttribute("for", listName + list.childElementCount);
    label.innerText = (list.childElementCount + 1); 
    
    div.appendChild(textarea);
    div.appendChild(label);

    let li = document.createElement("li");
    li.className = "list-group-item";
    li.appendChild(div);
    
    list.appendChild(li);
}