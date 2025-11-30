// Частицы Proton.js - БЕЛЫЕ
function initParticles() {
    const canvas = document.getElementById('particlesCanvas');
    const ctx = canvas.getContext('2d');
    
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);
    
    const proton = new Proton();
    const emitter = new Proton.Emitter();
    
    // Настройки для спокойных частиц
    emitter.rate = new Proton.Rate(Proton.getSpan(3, 8), Proton.getSpan(0.3, 0.6));
    emitter.addInitialize(new Proton.Radius(1, 2));
    emitter.addInitialize(new Proton.Life(4, 8));
    emitter.addInitialize(new Proton.Velocity(Proton.getSpan(0.1, 0.5), Proton.getSpan(0, 360), 'polar'));
    
    // БЕЛЫЕ частицы
    emitter.addBehaviour(new Proton.Alpha(1, 0));
    emitter.addBehaviour(new Proton.Color(['#ffffff', '#f8f8f8', '#e8e8e8', '#f0f0f0', '#f5f5f5']));
    emitter.addBehaviour(new Proton.Scale(1, 0.3));
    emitter.addBehaviour(new Proton.CrossZone(new Proton.RectZone(0, 0, canvas.width, canvas.height), 'bound'));
    
    // Эмиттер в центре экрана
    emitter.p.x = canvas.width / 2;
    emitter.p.y = canvas.height / 2;
    emitter.emit();
    
    const renderer = new Proton.CanvasRenderer(canvas);
    renderer.onProtonUpdate = function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    };
    
    proton.addRenderer(renderer);
    proton.addEmitter(emitter);
    
    function animate() {
        requestAnimationFrame(animate);
        proton.update();
    }
    
    animate();
}