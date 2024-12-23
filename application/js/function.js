function separadorMiles(input) {
    let separarNumber = input.toString().split('.');
    separarNumber[0] = separarNumber[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    return separarNumber.join('.')
}