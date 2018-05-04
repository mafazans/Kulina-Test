// Tampilkan Bilangan Fibbonaci dari berdasarkan user input?
// Soal yg ini juga tolong diperjelas yah yg dimaksud berdasarkan user input itu yg seperti apa? :)

// Pada jawaban saya di bawah ini akan menampilkan bilangan fibbonaci yg lebih kecil atau sama dengan user input

function fibonacci(num){
  let a = 1, b = 0, temp;
  const arr = [];
  while (num >= 0 && b < num){
    temp = a;
    a = a + b;
    b = temp;
    num--;
    arr.push(b);
  }
  return arr;
}