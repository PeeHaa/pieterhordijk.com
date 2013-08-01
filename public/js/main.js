(function() {
    // handle click on entire table rows (open source)
    var clickable = document.querySelectorAll('table.opensource tr.clickable');
    if (clickable) {
        for (var i = 0, l = clickable.length; i < l; i++) {
            clickable[i].addEventListener('click', function(e) {
                var link = e.target.parentNode.querySelector('a');

                window.location = link.getAttribute('href');

                e.preventDefault();
                e.stopPropagation();
            });
        }
    }

    // handle click on entire table rows (demos)
    var clickable = document.querySelectorAll('table.demos tr.clickable');
    if (clickable) {
        for (var i = 0, l = clickable.length; i < l; i++) {
            clickable[i].addEventListener('click', function(e) {
                if (e.target.nodeName === 'A') {
                    return;
                }

                var link = e.target.parentNode.querySelector('a');

                window.open(link.getAttribute('href'));

                e.preventDefault();
                e.stopPropagation();
            });
        }
    }

}());
