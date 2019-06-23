$(document).ready(function(){
    // sort alphabetically:
    let elements = $('#targets').find('option');
    console.log('finded:', elements);
    elements.sort((elemA, elemB) => {
        // negativo cero positivo
        return elemA.innerText.toLowerCase() < elemB.innerText.toLowerCase() ? -1 : elemA.innerText.toLowerCase() > elemB.innerText.toLowerCase();
    });
    $('#targets').html('');
    console.log('sorted:', elements);
    elements.each((idx, elem) => {
        let elemObj = $(elem);
        $('#targets').append('<option value="'+elemObj.val()+'">'+elemObj.text().toLowerCase()+'</option>');
    });
});