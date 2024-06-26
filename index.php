<?php include('Header.php');?>

    <section class="home" id="home">
        <div class="content">
            <h3>CryptoShow</h3>
            <p>Welcome to the CryptoShow</p>
            <a href="events.php" class="btn">Book Event</a>
        </div>
    </section>

    <section class="menu" id="menu">
        <h1 class="heading">Cryptographic <span>Devices</span></h1>
        <div class="box-container">
            <div class="box">
                <div class="box-head">
                    <img src="./image/Device1.jpg" alt="Jefferson disk">
                    <h3>Jefferson disk</h3>
                    <span>The Jefferson disk, is a cipher system commonly attributed to Thomas Jefferson</span>
                    <span> that uses a set of wheels or disks, each with letters of the alphabet arranged around</span>
                    <span> their edge in an order, which is different for each disk and is usually ordered randomly.</span>
                    <span> Each disk is marked with a unique number and a hole in the center of the disks allows them to be stacked on an axle. The disks are removable and can be mounted on the axle in any order desired. The order of the disks is the cipher key, and both sender and receiver must arrange the disks in the same predefined order.Once the disks have been placed on the axle in the agreed order, the sender rotates each disk up and down until a desired message is spelled out in one row.</span>
                </div>
            </div>
            <div class="box">
                <div class="box-head">
                    <img src="./image/Device2.jpg" alt="Enigma">
                    <h3>Enigma</h3>
                    <span>The Enigma was a portable electro-mechanical device using rotors (3 for the army, 4 for the navy) to encrypt and decipher messages. During the Second World War, the British mathematician Turing and his colleagues took up the work of the Polish mathematicians Rejewski, Różycki and Zygalski, who had managed to decipher messages sent by the Enigma using an electro-mechanical device nicknamed the "Rejewski bomb".</span>
                </div>
            </div>
            <div class="box">
                <div class="box-head">
                    <img src="./image/Device3.jpg" alt="PACE">
                    <h3>PACE</h3>
                    <span>PACE, short for Portable Automatic Cryptographic Equipment, is a handheld terminal for off-line encryption and decryption of tactical messages, developed in the early 1980s by Lehmkuhl in Norway. The device is NATO-approved up to the level of NATO SECRET 1 and is also known as the MI-300 Cryptographic Field Terminal by NFT Crypto from Oslo</span>
                </div>
            </div>
            <div class="box">
                <div class="box-head">
                    <img src="./image/Device4.jpg" alt="ETCRRM">
                    <h3>ETCRRM</h3>
                    <span>ETCRRM was an offline/online One-Time Tape cipher machine, developed around 1953 by Standard Telefon og Kabelfabrik A/S in Oslo, for use by the Norwegian Armed Forces and NATO. It uses the Vernam Cipher principle, implemented with valves and relays. From 1963 onwards, the machine was used on the Washington-Moscow hotline until it was succeeded in 1980 by the solid-state Siemens M-190. In the UK it was known as BID/570.</span>
                </div>
            </div>
        </div>
    </section>

    <?php
    $page_footer = <<< FOOTER
    <section class="footer">
        <footer>
            Zia Hassankhail, Kader Zamoulli, Muaaz Patel, Hassan Mojahed, Hassan Choudhry
        </footer>
    </section>

    <script src="./script.js"></script>
</body>
</html>
FOOTER;

    echo $page_footer;
    ?>