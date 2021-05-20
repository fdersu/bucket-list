let pagesArray = document.getElementsByClassName('pages');
let gridPages = document.getElementById('gridPages');
gridPages.style.width = '40vw';
gridPages.style.height = '5vh';
gridPages.style.display = 'grid';
let fraction = ' 1fr';
let stringBuilderColumns = '1fr 1fr';
for(let i = 1; i <= pagesArray.length; i++){
    stringBuilderColumns = stringBuilderColumns + fraction;
}
gridPages.style.gridTemplateColumns = stringBuilderColumns;
gridPages.style.gridTemplateRows = '1fr';

let areaEnd = 'next';
let stringBuilderAreas = 'previous ';
for(let i = 1; i <= pagesArray.length; i++){
    stringBuilderAreas = stringBuilderAreas + 'page' + i.toString() + ' ';
}
stringBuilderAreas = stringBuilderAreas + areaEnd;
gridPages.style.gridTemplateAreas = "'" + stringBuilderAreas + "'";
gridPages.style.justifyItems = 'center';
gridPages.style.alignItems = 'center';
let i = 0;
for(let item of pagesArray){
    i++
    item.style.gridArea = 'page' + i.toString();
}

let url = location.href;
let currentPage = parseInt(url.charAt(url.length - 1));
for(let item of pagesArray){
    if(item.innerText == currentPage){
        item.style.fontSize = '8vh';
        item.style.color = '#8a2703';
        item.style.textShadow = '3px 3px 5px #81b4d4';
    }
}