
function get_bookings()
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST","ajax/booking_records.php",true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
  xhr.onload = function(){
    document.getElementById('table-data').innerHTML = this.responseText;
   }
  
   xhr.send('get_bookings');

}



window.onload = function(){
  get_bookings();
}