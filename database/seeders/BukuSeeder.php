<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cm01 = Buku::create([
            'Barcode' => 'CM01',
            'Judul' => 'The boy, the mole, the fox and the horse',
            'Penulis' => 'Charlie Mackesy',
            'Penerbit' => 'Ebury Press',
            'TahunTerbit' => 2019,
            'Synopsis' => "Enter the world of Charlie's four unlikely friends, discover their story and their most important life lessons. The boy, the mole, the fox and the horse have been shared millions of times online - perhaps you've seen them? They've also been recreated by children in schools and hung on hospital walls. They sometimes even appear on lamp posts and on cafe and bookshop windows. Perhaps you saw the boy and mole on the Comic Relief T-shirt, Love Wins? Here, you will find them together in this book of Charlie's most-loved drawings, adventuring into the Wild and exploring the thoughts and feelings that unite us all.",
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/charles.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/charles.jpg')));

        $cm01->ImgBuku = $photoPath;
        $cm01->save();

        $hp01 = Buku::create([
            'Barcode' => 'HP01',
            'Judul' => 'Harry Potter: a magical year',
            'Penulis' => 'JK Rowling',
            'Penerbit' => 'Bloomsbury Publishing',
            'TahunTerbit' => 2021,
            'Synopsis' => 'A unique and beautiful gift book celebrating the art of Jim Kay, 366 magical moments from J.K Rowling’s Harry Potter novels, evoked in spellbinding brushstrokes, characterful ink work, and illuminating pencil sketches. This irresistible gift book takes readers on an unforgettable journey through the seasons at Hogwarts. Jim Kay’s captivating illustrations, paired with much-loved quotations from J.K. Rowling’s Harry Potter novels – one moment, anniversary, or memory for every day of the year – bring to life all of the magic, beauty, and wonder of the wizarding world.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/harrypotter.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/harrypotter.jpg')));

        $hp01->ImgBuku = $photoPath;
        $hp01->save();

        $rr01 = Buku::create([
            'Barcode' => 'RR01',
            'Judul' => 'Percy Jackson and the olympians #1 : the lightning thief = pencuri petir',
            'Penulis' => 'Rick Riordan',
            'Penerbit' => 'Noura Books',
            'TahunTerbit' => 2023,
            'Synopsis' => 'Aku Percy Jackson. Aku sudah dikeluarkan dari sekolah berkali-kali, sebagian karena aku penyandang disleksia dan GPPH (Gangguan Pemusatan Perhatian dan Hiperaktif), sebagian lagi karena masalah sepertinya suka sekali mengejarku ke mana pun aku pergi. Yang lebih buruk lagi, aku ternyata demigod. Kalau menurutmu memiliki orang tua dewata itu menyenangkan, kau salah. Sebagai demigod, kami harus menjalani misi dan menjadi pahlawan, yang berarti kami selalu diburu monster, dibenci oleh kebanyakan dewa, dan seringnya mati muda. Siapa ayahku? Yang jelas bukan Zeus karena dia menuduhku mencuri petirnya dan agak terlalu berambisi ingin mengenyahkan dari dunia. Dan, karena nasibku memang luar biasa buruk, aku cuma punya waktu sepuluh hari untuk membuktikan bahwa aku tidak bersalah sebelum para dewa berperang karena amukan Zeus. Dengan ramalan yang berkata, Dan, pada akhirnya, kau akan gagal menyelamatkan apa yang menurutmu paling signifikan.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/percy.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/percy.jpg')));

        $rr01->ImgBuku = $photoPath;
        $rr01->save();

        $sjm01 = Buku::create([
            'Barcode' => 'SJM01',
            'Judul' => 'Kingdom of ash : a throne of glass novel',
            'Penulis' => 'Sarah J. Maas',
            'Penerbit' => 'Bloomsbury Publishing',
            'TahunTerbit' => 2023,
            'Synopsis' => 'Aelin Galathynius has vowed to save her people but at a tremendous cost. Locked within an iron coffin by the Queen of the Fae, Aelin must draw upon her fiery will as she endures months of torture. The knowledge that yielding to Maeve will doom those she loves keeps her from breaking, but her resolve is unraveling with each passing day With Aelin captured, friends and allies are scattered to different fates. Some bonds will grow even deeper, while others will be severed forever. As destinies weave together at last, all must fight if Erilea is to have any hope of salvation.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/test.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/test.jpg')));

        $sjm01->ImgBuku = $photoPath;
        $sjm01->save();


        $sk01 = Buku::create([
            'Barcode' => 'SK01',
            'Judul' => 'Holly',
            'Penulis' => 'Stephen King',
            'Penerbit' => 'Scribner',
            'TahunTerbit' => 2023,
            'Synopsis' => "Stephen King's Holly marks the triumphant return of beloved King character Holly Gibney. Readers have witnessed Holly’s gradual transformation from a shy (but also brave and ethical) recluse in Mr. Mercedes to Bill Hodges’s partner in Finders Keepers to a full-fledged, smart, and occasionally tough private detective in The Outsider. In King’s new novel, Holly is on her own, and up against a pair of unimaginably depraved and brilliantly disguised adversaries.",
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/stephenking.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/stephenking.jpg')));

        $sk01->ImgBuku = $photoPath;
        $sk01->save();


        $kh01 = Buku::create([
            'Barcode' => 'KH01',
            'Judul' => 'Angsa dan kelelawar',
            'Penulis' => 'Keigo Higashino',
            'Penerbit' => 'Gramedia Pustaka Utama',
            'TahunTerbit' => 2023,
            'Synopsis' => 'Mereka berada tepat di perbatasan hitam dan putih, bagaikan cahaya dan bayangan, siang dan malam, angsa dan kelelawar. Mereka tidak seharusnya bertemu, tidak seharusnya berhubungan baik. Namun, takdir berkata lain. Dalam semalam, hidup Shiraishi Mirei dan Kuraki Kazuma berubah. Ayah Mirei berakhir menjadi mayat dan ayah Kazuma berakhir menjadi pembunuh. Shiraishi Kensuke ditemukan tewas ditikam dalam mobil. Mengingat profesinya sebagai pengacara, mungkin saja ada orang yang mendendam padanya. Namun, Mirei yakin sang ayah adalah sosok yang dihormati karena selalu tulus dan jujur dalam bekerja. Sementara itu, Kazuma sama sekali tidak percaya ketika ayahnya, Kuraki Tatsuro, yang pendiam mengaku sebagai pembunuh Kensuke. Terlebih lagi ketika ia diberitahu bahwa ini bukan pertama kalinya sang ayah membunuh seseorang. Semua bukti sangat meyakinkan, tetapi Mirei dan Kazuma tidak mampu menyingkirkan keraguan dalam hati mereka. Salah satunya adalah keluarga korban yang sedang berduka, sementara yang lain adalah keluarga pembunuh. Mereka bagaikan angsa dan kelelawar, tetapi memutuskan bekerja sama untuk mencari kebenaran... tanpa menyadari adanya kenyataan lain yang jauh lebih menyakitkan.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/ak.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/ak.jpg')));

        $kh01->ImgBuku = $photoPath;
        $kh01->save();



        $ms01 = Buku::create([
            'Barcode' => 'MS01',
            'Judul' => 'Cinta itu alasan sekaligus tujuan',
            'Penulis' => 'Maman Suherman',
            'Penerbit' => 'Grasindo',
            'TahunTerbit' => 2022,
            'Synopsis' => 'Buku Cinta Itu Alasan Sekaligus Tujuan merupakan buku yang ditulis oleh dua sahabat karib yang sering menunjukkan kemesraannya di linimasa Twitter. Mereka--oleh netizen-- dikenal sebagai Si Gundul dan Si Gondrong. Hal itu tidak lepas dari penampilan asli Kang Maman yang tanpa rambut alias gundul dan Gus Nadir yang rambutnya menjuntai menyentuh bahu alias gondrong. Dalam buku ini, mereka menuliskan keresahan masing-masing ke dalam bentuk puisi. Kang Maman sebagai tokoh publik dan sering bersinggungan dengan berbagai hal di dunia hiburan, terlihat dalam tema-tema puisinya yang beragam. Sementara Gus Nadir yang memiliki latar sebagai akademisi sekaligus kiai banyak menulis tentang hubungan dengan Tuhan dan Rasul.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/cinta.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/cinta.jpg')));

        $ms01->ImgBuku = $photoPath;
        $ms01->save();


        $hk01 = Buku::create([
            'Barcode' => 'HK01',
            'Judul' => 'The nightingale : Best seller #1 New York times',
            'Penulis' => 'Kristin Hannah',
            'Penerbit' => 'Elex Media Komputindo',
            'TahunTerbit' => 2023,
            'Synopsis' => 'Isabelle dan Vianne adalah kakak beradik dengan sifat yang bertolak belakang. Isabelle, sang adik, adalah gadis pemberani yang berpindah-pindah sekolah dan akhirnya menetap di Paris bersama ayahnya. Sementara itu, Vianne sang kakak, lebih pendiam dan memilih tinggal di pinggiran Prancis bersama suaminya, Antoine, dan anaknya. Ketika Perang Dunia II meletus, Antoine dikirim berperang, Isabelle pun diperintahkan ayah mereka untuk pergi menemui kakaknya dan tinggal bersama mereka untuk sementara. Hubungan beradik ini pun diuji. Dengan kondisi hidup yang berubah Vianne dan Isabelle harus menghadapi bermacam ketakutan. tetapi, hubungan mereka makin kuat, karena darah lebih kental daripada air.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/nightingale.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/nightingale.jpg')));

        $hk01->ImgBuku = $photoPath;
        $hk01->save();


        $JSK01 = Buku::create([
            'Barcode' => 'JSK01',
            'Judul' => 'Dompet Ayah Sepatu Ibu',
            'Penulis' => 'Jombang Santani Khairen',
            'Penerbit' => 'Gramedia Widiasarana',
            'TahunTerbit' => 2023,
            'Synopsis' => 'Zenna lahir urutan keenam dari sebelas saudara. Ia bersama keluarganya tinggal di punggung gunung Singgalang. Saat kecil, Zenna sudah bekerja keras untuk hidup. Ia pergi ke sekolah dengan sepatu rombeng naik-turun gunung sambil membawa jagung rebus untuk dijual. “Besok Abak belikan sepatu baru kalau sudah dapat uang,” janji Abaknya pada Zenna sebelum berangkat ke sekolah. Namun tak sempat Abak tunaikan janji itu. Abak meninggalkan Zenna untuk selamanya, juga meninggalkan janjinya pada Zenna untuk membelikan sepatu. Sebagai anak tengah-tengah, Zenna jarang mendapat perhatian. Ia menumpahkan kesedihannya pada dirinya sendiri. Ia bekerja keras dengan mandiri. Ia ingin melanjutkan janji Abaknya untuk membelikan sepatu. Ia membeli sepatu untuk dirinya sendiri. Di punggung gunung yang lain, gunung Marapi, Asrul dan adiknya Irsal harus membantu Umi untuk menghidupi diri. Bapaknya menikah lagi dan tinggal di rumah bersama istri keduanya, sehingga Umi, Asrul, dan Irsal pindah ke rumah peninggalan orang tua Umi. Berpisah dari Bapak. Meski Bapak kadang memberi mereka uang, itu tidaklah cukup. Setiap kali Asrul diberi uang oleh Bapak, Asrul selalu mengintip dompetnya, ada kayu manis yang diselipkan Bapak di sana. Asrul tak punya dompet karena ia tak pernah memegang uang. Bila pun dia punya, akan ia berikan pada Umi. Asrul ingin membuatkan rumah untuk Umi suatu saat kelak. Asrul dan Zenna akhirnya bertemu. Mereka berdua bertekad mengangkat derajat dirinya dan keluarganya ke kehidupan yang lebih baik. Mereka bertemu di kampus. Koran Harian Semangat turut merekatkan hubungan mereka. Hingga kelak mereka menikah dan memiliki rumah. Umi dan Umak mereka bawa tinggal bersama. Kehidupan mereka walau sudah lebih baik, tidak juga mudah. Musibah datang berkali-kali. “Kita pernah melewati yang lebih buruk dari ini,” kata mereka saling menguatkan.',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/dompet.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/dompet.jpg')));

        $JSK01->ImgBuku = $photoPath;
        $JSK01->save();


        $tk01 = Buku::create([
            'Barcode' => 'TK01',
            'Judul' => 'Dona dona',
            'Penulis' => 'Toshikazu Kawaguchi',
            'Penerbit' => 'Gramedia Pustaka Utama',
            'TahunTerbit' => 2023,
            'Synopsis' => 'Di sebuah lereng indah tak bernama di Hakodate, Hokkaido, berdiri Kafe Dona Dona yang menawarkan layanan istimewa kepada pengunjungnya: perjalananan melintasi waktu. Seperti di Funiculi Funicula yang ada di Tokyo, hal tersebut hanya dapat dilakukan jika berbagai peraturan yang merepotkan dipenuhi dan dengan secangkir kopi yang dituangkan oleh perempuan di keluarga Tokita. Mereka yang ingin memutar waktu adalah seorang wanita muda yang menyimpan dendam kepada orangtua yang menjadikannya yatim piatu kesepian, seorang komedian yang kehilangan tujuan hidup setelah berhasil mewujudkan impian mendiang istrinya, seorang adik yang khawatir kakaknya takkan bisa tersenyum lagi setelah kepergiannya, dan seorang pemuda yang tak mampu mengungkapkan cinta terpendam kepada sahabatnya. Mungkin perjalanan mereka hanya akan menyisakan kenangan. Namun, kehangatannya akan membekas dan barangkali, pada akhirnya, menumbuhkan tekad baru untuk menjalani hidup…',
            'Stock' => 10,
            'StatusKetersediaan' => 'Tersedia',
        ]);
        $photoPath = 'storage/buku/cover/dona.jpg';
        Storage::put($photoPath, file_get_contents(public_path('storage/buku/cover/dona.jpg')));

        $tk01->ImgBuku = $photoPath;
        $tk01->save();

    }
}
