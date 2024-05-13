function addInputToGroupList(listName) {
    let list = document.getElementById(listName);

    let input = document.createElement("input");
    input.className = "form-control";
    input.setAttribute("type", "text");
    input.setAttribute("name", listName + list.childElementCount);

    let li = document.createElement("li");
    li.className = "list-group-item";
    li.appendChild(input);
    
    list.appendChild(li);
}