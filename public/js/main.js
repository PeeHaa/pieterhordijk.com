(function() {
    // handle click on entire table rows
    var clickable = document.querySelectorAll('table tr.clickable');
    if (clickable) {
        for (var i = 0, l = clickable.length; i < l; i++) {
            clickable[i].addEventListener('click', function(e) {
                console.log(e.target.parentNode);
                var link = e.target.parentNode.querySelector('a');

                window.location = link.getAttribute('href');

                e.preventDefault();
                e.stopPropagation();
            });
        }
    }
}());
