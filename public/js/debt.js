function formatNumber(input) {
    // Remove any non-digit characters from the input value
    var value = input.value.replace(/\D/g, '');
  
    // Convert the value to a number and format it with commas
    var formattedValue = Number(value).toLocaleString();
  
    // Set the formatted value back to the input field
    input.value = formattedValue;
  }
   