let array = document.getElementsByClassName('link');
for(let item of array){
    item.addEventListener('mouseover', function(){
        document.body.style.background = 'radial-gradient(#81b4d4, #052336)';
        document.getElementById('navbar').style.backgroundColor = 'transparent';
        for(let one of array){
            if(item != one){
                one.style.color = '#8a2703';
            }
        }
    })
    item.addEventListener('mouseleave', function(){
        document.body.style.background = '#81b4d4';
        document.getElementById('navbar').style.backgroundColor = '#3e5882';
        for(let one of array){
            one.style.color = '#c24106';
        }
    })
}

