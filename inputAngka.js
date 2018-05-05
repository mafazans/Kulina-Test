// Ada Input angka: 1.345.679
// Buat pseudo code atau code sesuai bahasa yang dikuasai, agar menghasilkan
// output:
// 1000000
// 300000
// 40000
// 5000
// 600
// 70
// 9

function inputAngka(input){
	const regex = /\d/g;
	const angka = JSON.stringify(input).match(regex).join('');
	angka.toString().split('').map(function(number, index, arr) {
    console.log(number * Math.pow(10, arr.length - index - 1));
	});
}

inputAngka("1.345.679");