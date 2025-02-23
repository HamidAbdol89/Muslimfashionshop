document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.nav-link[data-widget="navbar-search"]').addEventListener('click', function() {
        const searchBlock = document.querySelector('.navbar-search-block');
        searchBlock.classList.toggle('open');
    });
});
