// Buat pseudo code atau code sesuai bahasa yang dikuasai untuk menampilkan
// bilangan prima berdasarkan user input

// Mohon maaf sebelumnya, akan lebih baik jika soalnya diberikan secara detail.
// Menampilkan bilangan prima berdasarkan input itu seperti apa? maksudnya ketika
// user menginputkan suatu angka apakah seharusnya kita menampilkan semua bilangan prima yg kurang dari user input?
// ataukan kita menampilkan bilangan prima ke - n sesuai dengan user input? misal jika user menginputkan 4 maka kita menampilkan bilangna prima ke 4?

// Pada jawaban saya di bawah ini akan menampilkan bilangan prima yg lebih kecil atau sama dengan user input

function bilanganPrima(limit) {
    const prime = [];
    for (let counter = 0; counter <= limit; counter++) {
        let notPrime = false;

        for (let i = 2; i <= counter; i++) {
            if (counter%i===0 && i!==counter) {
                notPrime = true;
            }
        }
        if (notPrime === false) {
            prime.push(counter);
        }
    }
    return prime;
}

bilanganPrima(100)