/* add code here */
var hideHighlight;
window.onload = init;
function init() {
    var highlightNodes = document.getElementById('highlight');
    highlightNodes.addEventListener('click', highlightNodesAction);
    hideHighlight = document.getElementById('hide');
    hideHighlight.addEventListener('click', hideHighlightAction);
    hideHighlight.style.display = "none";
}

function highlightNodesAction(e) {
    e.target.style.display = "none";
    hideHighlight.style.display = "block";
    var body = document.body;
    traverse(body);
}

function hideHighlightAction() {
    location.reload();
}

function traverse(body) {
    for (var i = 0; i < body.children.length; i++) {
        if (!body.children[i].classList.contains("hoverNode")) {
            var text = document.createTextNode(body.children[i].tagName)
            var span = document.createElement("span");
            span.appendChild(text);
            span.classList.add("hoverNode");
            span.addEventListener('click', displayAlert);
            body.children[i].appendChild(span);
            traverse(body.children[i]);
        }
    }
}

function displayAlert(e) {
    var tag = e.target.parentNode.tagName;
    var classes = e.target.parentNode.classList;
    var id = e.target.parentNode.id;
    var innerHTML = e.target.parentNode.innerHTML;
    var message = "Tag: " + tag + "\n" + "Class: " + classes + "\n" + "ID: " + id + "\n" + "innerHTML: " + innerHTML;
    alert(message);
}