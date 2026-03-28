import 'dart:io';
import 'dart:math';

void main() {
  Random random = Random();
  List<String> pilihan = ["gunting", "batu", "kertas"];

  String? repeat = "y";

  print("=== JANKENPON (Game Suit Kertas Batu Gunting)  ====");

  while (repeat == "y") {
    stdout.write("Pilih (gunting/batu/kertas) : ");
    String? user = stdin.readLineSync()?.toLowerCase();
    if (!pilihan.contains(user)) {
      print("Input tidak valid. Pilih (gunting/batu/kertas)");
      continue;
    }

    String komputer = pilihan[random.nextInt(3)];

    print("kamu memilih : $user"); 
    print("Komputer memilih : $komputer"); 

    if (user == komputer) {
      print("Hasil : Draw");
    } else if (
      (user == "kertas" && komputer == "batu") || (user == "batu" && komputer == "gunting") || (user == "gunting" && komputer == "kertas")
    ) {
      print("Hasil : Kamu Menang! Komputer Kalah!");
    } else {
      print("Hasil : Komputer Menang! Kamu Kalah");
    }

    stdout.write("Apakah kamu mau main lagi? Kalo iya, ketik 'y' : ");
    repeat = stdin.readLineSync()?.toLowerCase();

    print(" ");
  }

  print("Terimakasih sudah bermain Jankenpon!");
}