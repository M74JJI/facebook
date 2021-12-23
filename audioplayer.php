<audio class="player" src="assets/songs/Biggie Smalls - You're Nobody (Til Somebody Kills You).mp3" controls></audio>

<!-- <video class="player" src="http://caiman.graodemilho.com.br/wp-content/uploads/2019/03/Video_SPLASH_v3_leve.mp4" controls></video> -->

<div class="lyrics" style="display: none">
    7 | Yeah though I walk through the valley of the shadow of death
    11 | I will fear no evil
    13 | for you are with me
    15 | Your rod and your staff, they comfort me
    18 | You prepare a table for me, in the presence of my enemies
    22 | You anoint my head with oil, my cup overflows
    26 | Surely goodness and love will follow me all the days of my life
    31 | And I will dwell in the house of the Lord forever
    33.6 | Niggas in my faction don't like askin' questions
    37.5 | Strictly gun-testin', coke-measurin'
    40 | Givin' pleasure in the Benz-ito
</div>

<script>
const player = document.querySelector('.player')
const lyrics = document.querySelector('.lyrics')
const lines = lyrics.textContent.trim().split('\n')

lyrics.removeAttribute('style')
lyrics.innerText = ''

let syncData = []

lines.map((line, index) => {
    const [time, text] = line.trim().split('|')
    syncData.push({
        'start': time.trim(),
        'text': text.trim()
    })
})

player.addEventListener('timeupdate', () => {
    syncData.forEach((item) => {

        if (player.currentTime >= item.start) lyrics.innerText = item.text
    })
})
</script>