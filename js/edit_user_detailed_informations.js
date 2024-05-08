function addInputToGroupList(groupListName){
    let groupList = document.getElementById(groupListName);
    groupList.innerHTML += '<li class="list-group-item"> <input type="text" class="form-control" name="' + groupListName + groupList.childElementCount + '"> </li>';
}
