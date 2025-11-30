// Волновой эффект - БЕЛЫЕ частицы
class WaveEffect {
    constructor() {
        this.canvas = document.getElementById('waveCanvas');
        this.ctx = this.canvas.getContext('2d');
        this.particles = [];
        
        this.init();
        this.animate();
    }

    init() {
        this.resize();
        window.addEventListener('resize', () => this.resize());
        
        // Создаем случайные волны автоматически
        this.createRandomWaves();
    }

    resize() {
        this.canvas.width = window.innerWidth;
        this.canvas.height = window.innerHeight;
    }

    createRandomWaves() {
        // Создаем случайные волны в разных местах экрана
        setInterval(() => {
            if (Math.random() < 0.3) { // 30% шанс создать волну
                this.createWave(
                    Math.random() * this.canvas.width,
                    Math.random() * this.canvas.height
                );
            }
        }, 500); // Каждые 500ms
    }

    createWave(x, y) {
        // Создаем несколько БЕЛЫХ частиц для волны
        for (let i = 0; i < 5; i++) {
            this.particles.push({
                x: x,
                y: y,
                size: Math.random() * 4 + 1,
                speedX: (Math.random() - 0.5) * 2,
                speedY: (Math.random() - 0.5) * 2,
                life: 1,
                maxLife: 100,
                // БЕЛЫЕ цвета
                color: `hsl(0, 0%, ${80 + Math.random() * 20}%)`
            });
        }
    }

    animate() {
        this.ctx.fillStyle = 'rgba(0, 0, 0, 0.05)';
        this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);

        // Обновляем и рисуем частицы
        for (let i = this.particles.length - 1; i >= 0; i--) {
            const p = this.particles[i];
            
            p.x += p.speedX;
            p.y += p.speedY;
            p.life++;
            
            // Прозрачность зависит от оставшейся жизни
            const alpha = 1 - (p.life / p.maxLife);
            
            this.ctx.beginPath();
            this.ctx.arc(p.x, p.y, p.size * alpha, 0, Math.PI * 2);
            this.ctx.fillStyle = p.color.replace(')', `, ${alpha})`).replace('hsl', 'hsla');
            this.ctx.fill();
            
            // Удаляем старые частицы
            if (p.life >= p.maxLife) {
                this.particles.splice(i, 1);
            }
        }

        requestAnimationFrame(() => this.animate());
    }
}