
var colIndex = 0;
var widths = [];
$('.dataTable thead th').each(function() {
    widths.push(parseInt(this.style.width)+16);
})

$(".right-scroll").on('click', function() {
    
    if (colIndex == widths.length-1) return;
    document.querySelector('.dataTables_scrollBody').scrollLeft += widths[colIndex];
    colIndex++;
}) 
$(".left-scroll").on('click', function() {
    if (colIndex == 0) return;
    colIndex--;        
    var scrollLeft = 0;
    for (var i=0;i<colIndex;i++) { scrollLeft+=widths[i] }
    document.querySelector('.dataTables_scrollBody').scrollLeft = scrollLeft;
}) 