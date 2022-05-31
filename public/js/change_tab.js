$('.tabs ul li').click(function(){
    $(this).addClass('active').siblings().removeClass('active');
});

const tabTn = document.querySelectorAll('.tabs ul li');
const tab = document.querySelectorAll('.tab');

function tabs(pannelIndex){
    tab.forEach(function(node){
        node.style.display = 'none'; 
    });

    tab[pannelIndex].style.display = 'block';
}

tabs(0);

