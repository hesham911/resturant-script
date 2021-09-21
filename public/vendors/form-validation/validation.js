function clientFormValidation(formId  , array){
    form = document.getElementById(formId);
    document.getElementById('errorDiv') ? document.getElementById('errorDiv').remove() : '';
    var ul = document.createElement('ul'); 
    var div = createDiv(ul);
    form.prepend(div);
    for(var i =0 ; i < array.length ; i++){
        var children = form.getElementsByTagName(array[i]);
        inputTypeLoop(children ,ul );
    }
};

function inputTypeLoop (children , ul){
    for (let index = 0; index < children.length; index++) {
        const element = children[index];
        if (element.value == 0) {
            if (element.getAttribute("name") != '_token' && element.getAttribute("name") !='_method' ) {
                createListItem (element , ul);
            }
        }
    }
}

function createListItem (element , ul){
    var error = document.createElement('li');
    error.innerHTML = `please fill ${element.getAttribute("name")} ` ;
    error.classList.add('px-2') ;
    ul.prepend(error);
}

function createDiv(ul){
    var div = document.createElement('div'); 
    div.setAttribute("id", "errorDiv"); 
    div.classList.add('alert');
    div.classList.add('alert-danger');
    div.prepend(ul);
    return div
}