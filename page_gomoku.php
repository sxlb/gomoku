<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
/**
 * 五子棋游戏
 *
 * @package custom
 */
?>
<?php $this->need('component/header.php'); ?>

	<!-- aside -->
	<?php $this->need('component/aside.php'); ?>
	<!-- / aside -->

   <a class="off-screen-toggle hide"></a>
   <main class="app-content-body <?php echo Content::returnPageAnimateClass($this); ?>">
    <div class="hbox hbox-auto-xs hbox-auto-sm">
    <!--文章-->
     <div class="col center-part gpu-speed" id="post-panel">
    <!--标题下的一排功能信息图标：作者/时间/浏览次数/评论数/分类-->
		<?php  echo Content::exportPostPageHeader($this,$this->user->uid); ?>
      <div class="wrapper-md">
		<!--正文顶部的部件，如“返回首页”-->
       <?php echo Content::BreadcrumbNavigation($this, $this->options->rootUrl); ?>
       <!--博客文章样式 begin with .blog-post-->
       <div id="postpage" class="blog-post">
        <article class="single-post panel">
        <!--文章页面的头图-->
            <?php echo Content::exportHeaderImg($this); ?>
         <!--文章内容-->
         <div id="post-content" class="wrapper-lg">
             <?php $content = Content::postContentHtml($this, $this->user->uid); ?>
             
             <style>
:root {
    --board-cell-size: 32px;
    --board-border-radius: 8px;
    --btn-padding: 12px 28px;
    --btn-radius: 25px;
    --status-radius: 12px;
    --shadow-sm: 0 2px 8px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 15px rgba(0,0,0,0.15);
    --shadow-lg: 0 8px 30px rgba(0,0,0,0.3);
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    --gradient-danger: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    --gradient-blue: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    --gradient-green: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    --gradient-orange: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    --gradient-purple: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    --gradient-teal: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
}

.gomoku-container {
    max-width: 580px;
    margin: 20px auto;
    text-align: center;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    position: relative;
    z-index: 1;
}

.gomoku-settings {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8eb 100%);
    padding: 25px;
    border-radius: var(--board-border-radius);
    margin-bottom: 20px;
    box-shadow: var(--shadow-md);
}

.gomoku-settings h3 {
    margin: 0 0 20px;
    color: #2c3e50;
    font-size: 20px;
}

.setting-row {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 15px 0;
    gap: 15px;
    flex-wrap: wrap;
}

.setting-label {
    font-weight: 600;
    min-width: 85px;
    color: #34495e;
}

.gomoku-select {
    padding: 10px 18px;
    border: 2px solid #dcdde1;
    border-radius: 8px;
    font-size: 14px;
    background: white;
    cursor: pointer;
    transition: all 0.3s;
    min-width: 140px;
}

.gomoku-select:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
}

.gomoku-container .gomoku-btn {
    padding: var(--btn-padding);
    margin: 5px;
    background: var(--gradient-blue);
    color: white;
    border: none;
    border-radius: var(--btn-radius);
    cursor: pointer;
    font-size: 14px;
    transition: all 0.3s;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
}

.gomoku-container .gomoku-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

.gomoku-container .gomoku-btn:active { transform: translateY(0); }

.gomoku-container .gomoku-btn.start {
    background: var(--gradient-green);
    padding: 14px 50px;
    font-size: 16px;
    font-weight: bold;
}

.gomoku-container .gomoku-btn.reset { background: var(--gradient-danger); }
.gomoku-container .gomoku-btn.undo { background: var(--gradient-orange); }
.gomoku-container .gomoku-btn.hint { background: var(--gradient-purple); }
.gomoku-container .gomoku-btn.replay { background: var(--gradient-teal); }
.gomoku-container .gomoku-btn.history { background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); }
.gomoku-container .gomoku-btn:disabled {
    background: #bdc3c7;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.gomoku-board-wrapper { position: relative; display: inline-block; }

.gomoku-container .gomoku-board {
    display: inline-block;
    border: 4px solid var(--theme-color, #5D4037);
    padding: 8px;
    border-radius: var(--board-border-radius);
    box-shadow: var(--shadow-lg);
    touch-action: manipulation;
    background: var(--theme-bg, linear-gradient(135deg, #DEB887 0%, #D2B48C 100%));
}

.gomoku-board.theme-wood { --theme-color: #5D4037; --theme-bg: linear-gradient(135deg, #DEB887 0%, #D2B48C 100%); }
.gomoku-board.theme-modern { --theme-color: #2c3e50; --theme-bg: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%); }
.gomoku-board.theme-dark { --theme-color: #1a1a2e; --theme-bg: linear-gradient(135deg, #16213e 0%, #0f3460 100%); }
.gomoku-board.theme-green { --theme-color: #27ae60; --theme-bg: linear-gradient(135deg, #a8e063 0%, #56ab2f 100%); }

.gomoku-row { display: flex; }

.gomoku-cell {
    width: var(--board-cell-size);
    height: var(--board-cell-size);
    border: 1px solid rgba(0,0,0,0.2);
    position: relative;
    cursor: pointer;
    background: transparent;
    transition: background 0.2s;
}

.gomoku-cell:hover:not(.occupied) { background: rgba(255, 215, 0, 0.4); }
.gomoku-cell.occupied { cursor: not-allowed; }

.gomoku-cell::before {
    content: '';
    position: absolute;
    width: 5px;
    height: 5px;
    background: var(--theme-color, rgba(101, 67, 33, 0.5));
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.6;
}

.gomoku-cell.star-point::before { width: 10px; height: 10px; opacity: 1; }

.gomoku-cell.black::after,
.gomoku-cell.white::after {
    content: '';
    position: absolute;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.gomoku-cell.black::after {
    background: radial-gradient(circle at 35% 35%, #555, #000);
    box-shadow: 2px 2px 5px rgba(0,0,0,0.5);
}

.gomoku-cell.white::after {
    background: radial-gradient(circle at 35% 35%, #fff, #ddd);
    border: 1px solid #bbb;
    box-shadow: 2px 2px 5px rgba(0,0,0,0.3);
}

.gomoku-cell.hint-cell::before {
    width: 14px !important;
    height: 14px !important;
    background: rgba(155, 89, 182, 0.8) !important;
    z-index: 1;
}

.gomoku-cell.last-move::after {
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.8), 2px 2px 5px rgba(0,0,0,0.5);
}

.gomoku-cell.win {
    background: rgba(255, 215, 0, 0.6) !important;
}

.gomoku-cell.win::after {
    box-shadow: 0 0 0 4px #FFD700, 2px 2px 5px rgba(0,0,0,0.5);
}

.gomoku-container .gomoku-status {
    margin: 15px 0;
    padding: 15px;
    background: var(--gradient-primary);
    color: white;
    border-radius: var(--status-radius);
    font-size: 16px;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.gomoku-status.game-over { background: var(--gradient-success); }
.gomoku-status.draw { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }

.status-text { flex: 1; text-align: center; }

.sound-btn {
    background: rgba(255,255,255,0.2);
    border: none;
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
}

.sound-btn:hover { background: rgba(255,255,255,0.3); }

.gomoku-controls {
    margin-top: 15px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 5px;
}

.gomoku-legend {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    gap: 30px;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #555;
}

.legend-dot {
    width: 18px;
    height: 18px;
    border-radius: 50%;
}

.legend-dot.black { background: radial-gradient(circle at 35% 35%, #555, #000); }
.legend-dot.white { background: radial-gradient(circle at 35% 35%, #fff, #ddd); border: 1px solid #bbb; }

.thinking {
    display: inline-block;
    animation: pulse 0.8s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(0.95); }
}

.gomoku-stats {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 15px 0;
    flex-wrap: wrap;
}

.stat-item {
    background: white;
    padding: 10px 20px;
    border-radius: 10px;
    box-shadow: var(--shadow-sm);
    text-align: center;
    min-width: 80px;
}

.stat-value { font-size: 24px; font-weight: bold; color: #2c3e50; }
.stat-label { font-size: 12px; color: #7f8c8d; text-transform: uppercase; }
.stat-value.win { color: #27ae60; }
.stat-value.lose { color: #e74c3c; }
.stat-value.streak { color: #f39c12; }

.timer-display {
    background: var(--gradient-danger);
    color: white;
    padding: 8px 20px;
    border-radius: 20px;
    font-weight: bold;
    font-size: 18px;
}

.timer-display.warning { animation: timerPulse 0.5s infinite; }

@keyframes timerPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.replay-controls { margin: 15px 0; display: flex; }

.replay-slider {
    flex: 1;
    height: 6px;
    -webkit-appearance: none;
    appearance: none;
    background: #dcdde1;
    border-radius: 3px;
    margin: 0 15px;
    align-self: center;
}

.replay-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    background: #3498db;
    border-radius: 50%;
    cursor: pointer;
}

.theme-selector { display: flex; gap: 10px; justify-content: center; margin: 10px 0; }

.theme-option {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    cursor: pointer;
    border: 3px solid transparent;
    transition: all 0.3s;
}

.theme-option:hover { transform: scale(1.1); }
.theme-option.active { border-color: #3498db; box-shadow: 0 0 10px rgba(52, 152, 219, 0.5); }
.theme-option.wood { background: linear-gradient(135deg, #DEB887, #D2B48C); }
.theme-option.modern { background: linear-gradient(135deg, #ecf0f1, #bdc3c7); }
.theme-option.dark { background: linear-gradient(135deg, #16213e, #0f3460); }
.theme-option.green { background: linear-gradient(135deg, #a8e063, #56ab2f); }

.history-list { max-height: 200px; overflow-y: auto; margin: 10px 0; text-align: left; }

.history-item {
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
    transition: background 0.2s;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.history-item:hover { background: #f5f5f5; }

.history-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 15px;
    border-bottom: 1px solid #eee;
    font-weight: bold;
}

.history-date { font-size: 12px; color: #888; flex: 1; min-width: 150px; }
.history-mode { color: #3498db; font-weight: bold; }
.history-result { padding: 2px 8px; border-radius: 10px; font-size: 12px; }
.history-result.win, .history-result.black_win { background: #27ae60; color: white; }
.history-result.loss, .history-result.white_win { background: #e74c3c; color: white; }
.history-result.draw { background: #f39c12; color: white; }
.history-moves { color: #7f8c8d; font-size: 12px; }
.history-empty { padding: 20px; text-align: center; color: #999; }

@media (max-width: 520px) {
    :root { --board-cell-size: 24px; }
    .gomoku-cell.black::after, .gomoku-cell.white::after { width: 20px; height: 20px; }
    .setting-row { flex-direction: column; gap: 8px; }
    .gomoku-stats { gap: 10px; }
    .stat-item { padding: 8px 15px; min-width: 60px; }
    .stat-value { font-size: 18px; }
}
</style>

<div class="gomoku-container">
    <h2 style="text-align:center; margin-bottom:20px;">五子棋游戏</h2>

    <div class="gomoku-settings" id="settings-panel">
        <h3>⚙️ 游戏设置</h3>
        <div class="setting-row">
            <span class="setting-label">游戏模式:</span>
            <select class="gomoku-select" id="game-mode">
                <option value="pvp">👥 双人对战</option>
                <option value="ai">🤖 人机对战</option>
            </select>
        </div>
        <div class="setting-row" id="color-select-row">
            <span class="setting-label">玩家执棋:</span>
            <select class="gomoku-select" id="player-color">
                <option value="black">⚫ 黑方（先手）</option>
                <option value="white">⚪ 白方（后手）</option>
            </select>
        </div>
        <div class="setting-row" id="difficulty-row">
            <span class="setting-label">AI 难度:</span>
            <select class="gomoku-select" id="ai-difficulty">
                <option value="easy">🌱 简单</option>
                <option value="medium" selected>⭐ 中等</option>
                <option value="hard">💎 困难</option>
            </select>
        </div>
        <div class="setting-row">
            <span class="setting-label">计时模式:</span>
            <select class="gomoku-select" id="timer-mode">
                <option value="off">⏸️ 关闭</option>
                <option value="30">⏱️ 30秒/步</option>
                <option value="60">⏱️ 60秒/步</option>
            </select>
        </div>
        <div class="setting-row">
            <span class="setting-label">棋盘主题:</span>
            <div class="theme-selector">
                <div class="theme-option wood active" data-theme="wood" title="经典木纹"></div>
                <div class="theme-option modern" data-theme="modern" title="现代简约"></div>
                <div class="theme-option dark" data-theme="dark" title="暗夜模式"></div>
                <div class="theme-option green" data-theme="green" title="清新绿色"></div>
            </div>
        </div>
        <div class="setting-row">
            <button class="gomoku-btn start" id="start-btn">🎮 开始游戏</button>
        </div>
    </div>

    <div id="game-panel" style="display:none;">
        <div class="gomoku-stats">
            <div class="stat-item"><div class="stat-value win" id="win-count">0</div><div class="stat-label">胜利</div></div>
            <div class="stat-item"><div class="stat-value lose" id="lose-count">0</div><div class="stat-label">失败</div></div>
            <div class="stat-item"><div class="stat-value streak" id="streak-count">0</div><div class="stat-label">连胜</div></div>
        </div>

        <div class="gomoku-status" id="gomoku-status">
            <button class="sound-btn" id="sound-btn">🔊</button>
            <span class="status-text" id="status-text"><span id="current-player">黑方</span> 回合</span>
            <span class="timer-display" id="timer-display" style="display:none;">30</span>
        </div>

        <div class="gomoku-board-wrapper">
            <div class="gomoku-board theme-wood" id="gomoku-board"></div>
        </div>

        <div class="replay-controls" id="replay-controls" style="display:none;">
            <button class="gomoku-btn replay" id="replay-prev-btn">◀</button>
            <button class="gomoku-btn play" id="play-btn">⏸️</button>
            <input type="range" class="replay-slider" id="replay-slider" min="0" max="0" value="0">
            <button class="gomoku-btn replay" id="replay-next-btn">▶</button>
            <button class="gomoku-btn reset" id="exit-replay-btn">✕</button>
        </div>

        <div class="gomoku-controls">
            <button class="gomoku-btn" id="settings-btn">⚙️ 设置</button>
            <button class="gomoku-btn hint" id="hint-btn" disabled>💡 提示</button>
            <button class="gomoku-btn undo" id="undo-btn" disabled>↩️ 悔棋</button>
            <button class="gomoku-btn replay" id="replay-btn" disabled>📹 回放</button>
            <button class="gomoku-btn history" id="history-btn">📜 历史</button>
            <button class="gomoku-btn reset" id="reset-btn">🔄 重开</button>
        </div>

        <div class="gomoku-legend">
            <div class="legend-item"><div class="legend-dot black"></div><span>黑方（先手）</span></div>
            <div class="legend-item"><div class="legend-dot white"></div><span>白方（后手）</span></div>
        </div>

        <div class="history-list" id="history-list" style="display:none;">
            <div class="history-header">
                <span>历史记录</span>
                <button class="gomoku-btn history-clear" id="clear-history-btn" style="padding:4px 10px;font-size:12px;">清空</button>
            </div>
            <div class="history-items" id="history-items"></div>
        </div>
    </div>
</div>

<script>
const Gomoku = (function() {
    const BOARD_SIZE = 15;
    const STAR_POINTS = [[3,3],[3,7],[3,11],[7,3],[7,7],[7,11],[11,3],[11,7],[11,11]];
    const DIFFICULTY_CONFIG = { easy: { depth: 1, candidates: 8 }, medium: { depth: 2, candidates: 12 }, hard: { depth: 3, candidates: 15 } };

    let state = {
        board: [], currentPlayer: 'black', gameOver: false,
        moveHistory: [], winCells: [], lastAIMove: null, hintCell: null,
        gameMode: 'pvp', playerColor: 'black', humanPlayer: 'black',
        aiDifficulty: 'medium', timerMode: 'off', boardTheme: 'wood',
        soundEnabled: true, audioCtx: null,
        timerInterval: null, timerValue: 30,
        stats: { wins: 0, losses: 0, streak: 0 },
        replayMode: false, replayIndex: 0,
        autoPlay: false, autoPlayInterval: null, playSpeed: 500
    };

    function initAudio() {
        if (!state.audioCtx) state.audioCtx = new (window.AudioContext || window.webkitAudioContext)();
    }

    function playSound(type) {
        if (!state.soundEnabled) return;
        initAudio();
        const ctx = state.audioCtx;

        if (type === 'place') {
            const osc = ctx.createOscillator(), gain = ctx.createGain();
            osc.connect(gain); gain.connect(ctx.destination);
            osc.frequency.value = 800; osc.type = 'sine';
            gain.gain.setValueAtTime(0.3, ctx.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.1);
            osc.start(); osc.stop(ctx.currentTime + 0.1);
        } else if (type === 'win' || type === 'lose') {
            const notes = type === 'win' ? [523, 659, 784, 1047] : [400, 350, 300, 250];
            const interval = type === 'win' ? 0.15 : 0.2;
            notes.forEach((freq, i) => {
                const osc = ctx.createOscillator(), gain = ctx.createGain();
                osc.connect(gain); gain.connect(ctx.destination);
                osc.frequency.value = freq; osc.type = 'sine';
                gain.gain.setValueAtTime(0.2, ctx.currentTime + i * interval);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + i * interval + 0.4);
                osc.start(ctx.currentTime + i * interval);
                osc.stop(ctx.currentTime + i * interval + 0.4);
            });
        }
    }

    function isStarPoint(r, c) {
        return STAR_POINTS.some(p => p[0] === r && p[1] === c);
    }

    function initBoard() {
        state.board = Array(BOARD_SIZE).fill(null).map(() => Array(BOARD_SIZE).fill(null));
        renderBoard();
    }

    function renderBoard() {
        const boardEl = document.getElementById('gomoku-board');
        boardEl.innerHTML = '';

        for (let i = 0; i < BOARD_SIZE; i++) {
            const row = document.createElement('div');
            row.className = 'gomoku-row';

            for (let j = 0; j < BOARD_SIZE; j++) {
                const cell = document.createElement('div');
                cell.className = 'gomoku-cell';
                cell.dataset.row = i;
                cell.dataset.col = j;

                if (isStarPoint(i, j)) cell.classList.add('star-point');

                if (state.replayMode) {
                    // 显示从第1手到当前replayIndex的所有棋子
                    for (let k = 0; k < state.replayIndex; k++) {
                        const move = state.moveHistory[k];
                        if (move.row === i && move.col === j) {
                            cell.classList.add(move.player);
                            // 最后一步高亮
                            if (k === state.replayIndex - 1) cell.classList.add('last-move');
                        }
                    }
                } else {
                    if (state.board[i][j]) cell.classList.add(state.board[i][j], 'occupied');
                    if (state.winCells.some(c => c.row === i && c.col === j)) cell.classList.add('win');
                    if (state.hintCell && state.hintCell.row === i && state.hintCell.col === j) cell.classList.add('hint-cell');
                    if (state.moveHistory.length > 0) {
                        const last = state.moveHistory[state.moveHistory.length - 1];
                        if (last && last.row === i && last.col === j && !(state.hintCell && state.hintCell.row === i && state.hintCell.col === j)) {
                            cell.classList.add('last-move');
                        }
                    }
                    cell.addEventListener('click', handleCellClick);
                }

                row.appendChild(cell);
            }
            boardEl.appendChild(row);
        }
    }

    function handleCellClick(e) {
        if (state.gameOver || state.replayMode) return;
        if (state.gameMode === 'ai' && state.currentPlayer !== state.humanPlayer) return;

        const row = parseInt(e.target.dataset.row);
        const col = parseInt(e.target.dataset.col);

        if (state.board[row][col]) return;

        state.hintCell = null;
        makeMove(row, col);

        if (state.gameMode === 'ai' && !state.gameOver) setTimeout(aiMove, 300);
    }

    function makeMove(row, col) {
        state.board[row][col] = state.currentPlayer;
        state.moveHistory.push({ row, col, player: state.currentPlayer });
        playSound('place');

        document.getElementById('undo-btn').disabled = false;
        document.getElementById('replay-btn').disabled = state.moveHistory.length < 2;
        resetTimer();

        if (checkWin(row, col)) {
            state.gameOver = true;
            const playerName = state.currentPlayer === 'black' ? '黑方' : '白方';
            document.getElementById('gomoku-status').innerHTML = `<button class="sound-btn" id="sound-btn">🔊</button><span class="status-text"><span style="font-size:20px">🎉</span> ${playerName} 获胜！</span>`;
            document.getElementById('sound-btn')?.addEventListener('click', toggleSound);
            document.getElementById('gomoku-status').classList.add('game-over');
            stopTimer();

            if (state.gameMode === 'ai') {
                if (state.currentPlayer === state.humanPlayer) {
                    state.stats.wins++; state.stats.streak++;
                    playSound('win');
                } else {
                    state.stats.losses++; state.stats.streak = 0;
                    playSound('lose');
                }
                saveStats();
            }
            state.lastAIMove = { row, col };
            renderBoard();
            return;
        }

        if (isBoardFull()) {
            state.gameOver = true;
            document.getElementById('gomoku-status').innerHTML = '<span class="status-text">🤝 平局！</span>';
            document.getElementById('gomoku-status').classList.add('draw');
            stopTimer();
            renderBoard();
            return;
        }

        state.currentPlayer = state.currentPlayer === 'black' ? 'white' : 'black';
        updateStatus();
        renderBoard();
    }

    function checkWin(row, col) {
        const player = state.board[row][col];
        const directions = [[[0,1],[0,-1]],[[1,0],[-1,0]],[[1,1],[-1,-1]],[[1,-1],[-1,1]]];

        for (const [dir1, dir2] of directions) {
            const cells = [{ row, col }];
            checkDirection(row, col, dir1[0], dir1[1], player, cells);
            checkDirection(row, col, dir2[0], dir2[1], player, cells);
            if (cells.length >= 5) {
                state.winCells = cells;
                return true;
            }
        }
        return false;
    }

    function checkDirection(row, col, dr, dc, player, cells) {
        let r = row + dr, c = col + dc;
        while (r >= 0 && r < BOARD_SIZE && c >= 0 && c < BOARD_SIZE && state.board[r][c] === player) {
            cells.push({ row: r, col: c });
            r += dr; c += dc;
        }
    }

    function isBoardFull() {
        return state.board.every(row => row.every(cell => cell !== null));
    }

    function updateStatus() {
        const playerName = state.currentPlayer === 'black' ? '黑方' : '白方';
        const statusEl = document.getElementById('gomoku-status');

        if (state.gameMode === 'ai' && state.currentPlayer !== state.humanPlayer) {
            statusEl.innerHTML = `<button class="sound-btn" id="sound-btn">${state.soundEnabled ? '🔊' : '🔇'}</button><span class="status-text"><span class="thinking">🤖 AI 思考中...</span></span><span class="timer-display" id="timer-display" style="display:none;">${state.timerValue}</span>`;
        } else {
            const tag = state.gameMode === 'ai' ? '(你)' : '';
            statusEl.innerHTML = `<button class="sound-btn" id="sound-btn">${state.soundEnabled ? '🔊' : '🔇'}</button><span class="status-text"><span id="current-player">${playerName}</span> ${tag} 回合</span><span class="timer-display" id="timer-display" style="display:none;">${state.timerValue}</span>`;
        }
        document.getElementById('sound-btn')?.addEventListener('click', toggleSound);
        statusEl.classList.remove('game-over', 'draw');
    }

    function startTimer() {
        if (state.timerMode === 'off') return;
        state.timerValue = parseInt(state.timerMode);
        updateTimerDisplay();

        state.timerInterval = setInterval(() => {
            state.timerValue--;
            updateTimerDisplay();

            if (state.timerValue <= 5) document.getElementById('timer-display')?.classList.add('warning');
            if (state.timerValue <= 0) {
                stopTimer();
                if (!state.gameOver) {
                    if (state.gameMode === 'ai' && state.currentPlayer === state.humanPlayer) {
                        aiMove();
                    } else if (state.gameMode === 'pvp') {
                        state.gameOver = true;
                        const next = state.currentPlayer === 'black' ? 'white' : 'black';
                        document.getElementById('gomoku-status').innerHTML = `<span class="status-text">⏰ ${next === 'black' ? '黑方' : '白方'} 超时！</span>`;
                        document.getElementById('gomoku-status').classList.add('game-over');
                    }
                }
            }
        }, 1000);
    }

    function resetTimer() { stopTimer(); startTimer(); }

    function stopTimer() {
        if (state.timerInterval) { clearInterval(state.timerInterval); state.timerInterval = null; }
    }

    function updateTimerDisplay() {
        const el = document.getElementById('timer-display');
        if (el) { el.textContent = state.timerValue; el.style.display = state.timerMode === 'off' ? 'none' : 'inline-block'; el.classList.toggle('warning', state.timerValue <= 5); }
    }

    function aiMove() {
        if (state.gameOver) return;
        const config = DIFFICULTY_CONFIG[state.aiDifficulty];
        const move = findBestMove(config.depth, config.candidates);
        state.lastAIMove = move;
        makeMove(move.row, move.col);
    }

    function findBestMove(depth, maxCandidates) {
        let bestScore = -Infinity, bestMoves = [];
        const candidates = getCandidateMoves(maxCandidates);

        if (state.moveHistory.length === 0) return { row: 7, col: 7 };

        for (const { row, col } of candidates) {
            state.board[row][col] = 'white';
            const score = minimax(depth - 1, -Infinity, Infinity, false);
            state.board[row][col] = null;

            if (score > bestScore) { bestScore = score; bestMoves = [{ row, col }]; }
            else if (score === bestScore) bestMoves.push({ row, col });
        }

        return bestMoves[Math.floor(Math.random() * bestMoves.length)];
    }

    function getCandidateMoves(maxCandidates = 12) {
        const moves = [], checked = new Set();

        for (let i = 0; i < BOARD_SIZE; i++) {
            for (let j = 0; j < BOARD_SIZE; j++) {
                if (state.board[i][j]) {
                    for (let di = -2; di <= 2; di++) {
                        for (let dj = -2; dj <= 2; dj++) {
                            const ni = i + di, nj = j + dj, key = `${ni},${nj}`;
                            if (ni >= 0 && ni < BOARD_SIZE && nj >= 0 && nj < BOARD_SIZE && !state.board[ni][nj] && !checked.has(key)) {
                                checked.add(key);
                                moves.push({ row: ni, col: nj });
                            }
                        }
                    }
                }
            }
        }

        if (moves.length === 0) return [{ row: 7, col: 7 }];

        return moves.sort((a, b) => evaluatePosition(a.row, a.col, 'white') - evaluatePosition(b.row, b.col, 'white')).slice(-maxCandidates).reverse();
    }

    function minimax(depth, alpha, beta, isMaximizing) {
        if (depth === 0) return evaluateBoard();

        const candidates = getCandidateMoves(state.aiDifficulty === 'hard' ? 10 : 8);

        if (isMaximizing) {
            let maxScore = -Infinity;
            for (const { row, col } of candidates) {
                state.board[row][col] = 'white';
                maxScore = Math.max(maxScore, minimax(depth - 1, alpha, beta, false));
                state.board[row][col] = null;
                alpha = Math.max(alpha, maxScore);
                if (beta <= alpha) break;
            }
            return maxScore;
        } else {
            let minScore = Infinity;
            for (const { row, col } of candidates) {
                state.board[row][col] = 'black';
                minScore = Math.min(minScore, minimax(depth - 1, alpha, beta, true));
                state.board[row][col] = null;
                beta = Math.min(beta, minScore);
                if (beta <= alpha) break;
            }
            return minScore;
        }
    }

    function evaluateBoard() {
        let score = 0;
        for (let i = 0; i < BOARD_SIZE; i++) {
            for (let j = 0; j < BOARD_SIZE; j++) {
                if (state.board[i][j] === 'white') score += evaluatePosition(i, j, 'white');
                else if (state.board[i][j] === 'black') score -= evaluatePosition(i, j, 'black');
            }
        }
        return score;
    }

    function evaluatePosition(row, col, player) {
        const directions = [[0,1],[1,0],[1,1],[1,-1]];
        return directions.reduce((sum, [dr, dc]) => sum + evaluateLine(getLine(row, col, dr, dc, player), player), 0);
    }

    function getLine(row, col, dr, dc, player) {
        let start = { r: row, c: col }, end = { r: row, c: col };

        while (start.r - dr >= 0 && start.r - dr < BOARD_SIZE && start.c - dc >= 0 && start.c - dc < BOARD_SIZE && state.board[start.r - dr][start.c - dc] === player) {
            start.r -= dr; start.c -= dc;
        }
        while (end.r + dr >= 0 && end.r + dr < BOARD_SIZE && end.c + dc >= 0 && end.c + dc < BOARD_SIZE && state.board[end.r + dr][end.c + dc] === player) {
            end.r += dr; end.c += dc;
        }

        const line = [];
        let r = start.r, c = start.c;
        while (true) {
            line.push({ row: r, col: c, value: (r === row && c === col) ? player : state.board[r][c] });
            if (r === end.r && c === end.c) break;
            r += dr; c += dc;
        }
        return line;
    }

    function evaluateLine(line, player) {
        const patterns = [
            { p: [player,player,player,player,player], s: 100000 },
            { p: [null,player,player,player,player,null], s: 50000 },
            { p: [player,player,player,player,null], s: 5000 },
            { p: [null,player,player,player,player], s: 5000 },
            { p: [player,player,player,null,player], s: 5000 },
            { p: [player,player,null,player,player], s: 5000 },
            { p: [null,null,player,player,player,null], s: 2000 },
            { p: [null,player,player,player,null,null], s: 2000 },
            { p: [player,player,null,player,null], s: 500 },
            { p: [player,null,player,player,null], s: 500 },
            { p: [null,player,player,null,player], s: 500 },
            { p: [player,player,null,null,player], s: 500 },
            { p: [null,null,player,player,null], s: 100 },
            { p: [null,player,null,player,null], s: 50 },
            { p: [player,null,null,null,player], s: 50 }
        ];

        const lineStr = line.map(l => l.value || 'null').join(',');
        for (const { p, s } of patterns) {
            if (lineStr.includes(p.join(','))) return s;
        }
        return line.filter(l => l.value === player).length * 3;
    }

    function showHint() {
        if (state.gameOver || state.replayMode) return;
        if (state.gameMode === 'ai' && state.currentPlayer !== state.humanPlayer) return;

        state.hintCell = null;
        const config = DIFFICULTY_CONFIG[state.aiDifficulty];
        const move = findBestMove(config.depth, 8);
        state.hintCell = { row: move.row, col: move.col };
        renderBoard();
    }

    function saveStats() { localStorage.setItem('gomokuStats', JSON.stringify(state.stats)); }
    function loadStats() { const s = localStorage.getItem('gomokuStats'); if (s) state.stats = JSON.parse(s); }

    function updateStatsDisplay() {
        document.getElementById('win-count').textContent = state.stats.wins;
        document.getElementById('lose-count').textContent = state.stats.losses;
        document.getElementById('streak-count').textContent = state.stats.streak;
    }

    function saveHistory() {
        const historyEl = document.getElementById('history-list');
        const games = JSON.parse(localStorage.getItem('gomokuHistory') || '[]');

        let result = 'draw';
        if (state.gameOver) {
            if (state.gameMode === 'pvp') result = state.currentPlayer === 'black' ? 'black_win' : 'white_win';
            else result = state.currentPlayer === state.humanPlayer ? 'win' : 'loss';
        }

        const difficultyText = state.gameMode === 'ai' ? ['简单', '中等', '困难'][{easy:0,medium:1,hard:2}[state.aiDifficulty] || 1] : '';

        games.unshift({
            mode: state.gameMode, difficulty: state.aiDifficulty, player: state.playerColor,
            result, moves: [...state.moveHistory], date: new Date().toLocaleString(),
            moveCount: state.moveHistory.length, difficultyText
        });
        if (games.length > 10) games.pop();

        localStorage.setItem('gomokuHistory', JSON.stringify(games));
        historyEl.innerHTML = games.map((g, i) => {
            const resultClass = g.result === 'win' || g.result === 'black_win' ? 'win' : g.result === 'loss' || g.result === 'white_win' ? 'loss' : 'draw';
            const resultText = g.result === 'win' ? '胜' : g.result === 'loss' ? '负' : g.result === 'black_win' ? '黑胜' : g.result === 'white_win' ? '白胜' : '平';
            return `<div class="history-item" onclick="Gomoku.loadHistory(${i})"><span class="history-date">${g.date}</span><span class="history-mode">${g.mode === 'ai' ? 'AI(' + g.difficultyText + ')' : '双人对战'}</span><span class="history-result ${resultClass}">${resultText}</span><span class="history-moves">${g.moveCount}手</span></div>`;
        }).join('');
    }

    function startReplay() {
        if (state.moveHistory.length < 2) return;
        saveHistory();
        state.replayMode = true;
        state.replayIndex = 0;
        state.autoPlay = false;
        stopAutoPlay();

        document.getElementById('replay-controls').style.display = 'flex';
        document.getElementById('replay-slider').max = state.moveHistory.length;
        document.getElementById('replay-slider').value = 0;
        document.getElementById('play-btn').textContent = '▶️';
        const modeText = state.gameMode === 'ai' ? 'AI(' + ['简单', '中等', '困难'][{easy:0,medium:1,hard:2}[state.aiDifficulty] || 1] + ')' : '双人对战';
        document.getElementById('gomoku-status').innerHTML = `<span class="status-text">📹 回放: ${modeText} - ${state.moveHistory.length}手</span>`;
        document.getElementById('hint-btn').disabled = true;
        renderBoard();
    }

    function toggleAutoPlay() {
        state.autoPlay = !state.autoPlay;
        if (state.autoPlay) {
            // 如果在最后一步，回到开头
            if (state.replayIndex >= state.moveHistory.length) {
                state.replayIndex = 0;
            }
            document.getElementById('play-btn').textContent = '⏸️';
            startAutoPlay();
        } else {
            document.getElementById('play-btn').textContent = '▶️';
            stopAutoPlay();
        }
    }

    function startAutoPlay() {
        if (state.autoPlayInterval) return;
        state.autoPlayInterval = setInterval(() => {
            if (state.replayIndex < state.moveHistory.length) {
                state.replayIndex++;
                document.getElementById('replay-slider').value = state.replayIndex;
                renderBoard();
            } else {
                // 播放结束
                state.autoPlay = false;
                document.getElementById('play-btn').textContent = '▶️';
                stopAutoPlay();
            }
        }, state.playSpeed);
    }

    function stopAutoPlay() {
        if (state.autoPlayInterval) {
            clearInterval(state.autoPlayInterval);
            state.autoPlayInterval = null;
        }
    }

    function clearHistory() {
        if (!confirm('确定要清空所有历史记录吗？')) return;
        localStorage.removeItem('gomokuHistory');
        updateHistoryList();
    }

    function updateHistoryList() {
        const el = document.getElementById('history-items');
        const games = JSON.parse(localStorage.getItem('gomokuHistory') || '[]');
        el.innerHTML = games.length > 0 ? games.map((g, i) => {
            const resultClass = g.result === 'win' || g.result === 'black_win' ? 'win' : g.result === 'loss' || g.result === 'white_win' ? 'loss' : 'draw';
            const resultText = g.result === 'win' ? '胜' : g.result === 'loss' ? '负' : g.result === 'black_win' ? '黑胜' : g.result === 'white_win' ? '白胜' : '平';
            return `<div class="history-item" onclick="Gomoku.loadHistory(${i})"><span class="history-date">${g.date}</span><span class="history-mode">${g.mode === 'ai' ? 'AI(' + g.difficultyText + ')' : '双人对战'}</span><span class="history-result ${resultClass}">${resultText}</span><span class="history-moves">${g.moveCount}手</span></div>`;
        }).join('') : '<div class="history-empty">暂无历史记录</div>';
    }

    function replayPrev() {
        if (state.replayIndex > 0) {
            state.replayIndex--;
            document.getElementById('replay-slider').value = state.replayIndex;
            renderBoard();
        }
    }

    function replayNext() {
        if (state.replayIndex < state.moveHistory.length) {
            state.replayIndex++;
            document.getElementById('replay-slider').value = state.replayIndex;
            renderBoard();
        }
    }

    function loadHistory(index) {
        const games = JSON.parse(localStorage.getItem('gomokuHistory') || '[]');
        const game = games[index];
        if (!game) return;

        state.moveHistory = [...game.moves];
        state.replayMode = true;
        state.replayIndex = 0; // 从第一手开始
        state.autoPlay = false;
        stopAutoPlay();
        state.gameMode = game.mode;
        state.aiDifficulty = game.difficulty;

        document.getElementById('replay-controls').style.display = 'flex';
        document.getElementById('replay-slider').max = state.moveHistory.length;
        document.getElementById('replay-slider').value = 0;
        document.getElementById('play-btn').textContent = '▶️';
        const modeText = game.mode === 'ai' ? 'AI(' + game.difficultyText + ')' : '双人对战';
        const resultClass = game.result === 'win' || game.result === 'black_win' ? 'win' : game.result === 'loss' || game.result === 'white_win' ? 'loss' : 'draw';
        const resultText = game.result === 'win' ? '胜' : game.result === 'loss' ? '负' : game.result === 'black_win' ? '黑胜' : game.result === 'white_win' ? '白胜' : '平';
        document.getElementById('gomoku-status').innerHTML = `<span class="status-text">📹 ${game.date} - ${modeText} - <span class="history-result ${resultClass}" style="padding:2px 8px;border-radius:10px;">${resultText}</span> - ${game.moveCount}手</span>`;
        document.getElementById('hint-btn').disabled = true;
        document.getElementById('history-list').style.display = 'none';
        renderBoard();
    }

    function toggleHistory() {
        const el = document.getElementById('history-list');
        const isVisible = el.style.display === 'block';
        el.style.display = isVisible ? 'none' : 'block';
        if (!isVisible) {
            updateHistoryList();
        }
    }

    function exitReplay() {
        state.replayMode = false;
        state.replayIndex = 0;
        state.autoPlay = false;
        stopAutoPlay();
        document.getElementById('replay-controls').style.display = 'none';
        document.getElementById('history-list').style.display = 'none';
        initBoard();
        updateStatus();
    }

    function setBoardTheme(theme) {
        state.boardTheme = theme;
        document.getElementById('gomoku-board').className = 'gomoku-board theme-' + theme;
        document.querySelectorAll('.theme-option').forEach(el => el.classList.toggle('active', el.dataset.theme === theme));
    }

    function resetGameState() {
        state.board = []; state.currentPlayer = 'black'; state.gameOver = false;
        state.moveHistory = []; state.winCells = []; state.lastAIMove = null;
        state.hintCell = null; state.replayMode = false; state.replayIndex = 0;
        stopTimer();

        document.getElementById('gomoku-status').innerHTML = `<button class="sound-btn" id="sound-btn">${state.soundEnabled ? '🔊' : '🔇'}</button><span class="status-text"><span id="current-player">黑方</span> 回合</span><span class="timer-display" id="timer-display" style="display:none;">${state.timerMode === 'off' ? '' : state.timerMode}</span>`;
        document.getElementById('sound-btn')?.addEventListener('click', toggleSound);
        document.getElementById('gomoku-status').classList.remove('game-over', 'draw');
        document.getElementById('undo-btn').disabled = true;
        document.getElementById('replay-btn').disabled = true;
        document.getElementById('hint-btn').disabled = state.gameMode === 'pvp';
        document.getElementById('replay-controls').style.display = 'none';
    }

    function toggleSound() {
        state.soundEnabled = !state.soundEnabled;
        document.getElementById('sound-btn').textContent = state.soundEnabled ? '🔊' : '🔇';
    }

    function undo() {
        if (state.moveHistory.length === 0 || state.gameOver) return;
        stopTimer();

        if (state.gameMode === 'ai') {
            if (state.moveHistory.length < 2) return;
            for (let i = 0; i < 2; i++) { const m = state.moveHistory.pop(); state.board[m.row][m.col] = null; }
        } else {
            const m = state.moveHistory.pop(); state.board[m.row][m.col] = null;
        }

        state.currentPlayer = 'black'; state.winCells = []; state.gameOver = false;
        state.lastAIMove = null; state.hintCell = null;
        updateStatus();

        document.getElementById('undo-btn').disabled = state.moveHistory.length === 0;
        document.getElementById('replay-btn').disabled = state.moveHistory.length < 2;
        renderBoard();
        startTimer();
    }

    function start() {
        state.gameMode = document.getElementById('game-mode').value;
        state.playerColor = document.getElementById('player-color').value;
        state.humanPlayer = state.playerColor;
        state.aiDifficulty = document.getElementById('ai-difficulty').value;
        state.timerMode = document.getElementById('timer-mode').value;
        state.boardTheme = document.querySelector('.theme-option.active')?.dataset.theme || 'wood';
        state.currentPlayer = 'black';

        document.getElementById('settings-panel').style.display = 'none';
        document.getElementById('game-panel').style.display = 'block';
        document.getElementById('replay-controls').style.display = 'none';
        document.getElementById('history-list').style.display = 'none';
        state.replayMode = false;

        if (state.gameMode === 'ai') {
            document.getElementById('hint-btn').disabled = false;
            document.getElementById('color-select-row').style.display = 'flex';
            document.getElementById('difficulty-row').style.display = 'flex';
        } else {
            document.getElementById('hint-btn').disabled = true;
        }

        document.getElementById('undo-btn').disabled = true;
        document.getElementById('replay-btn').disabled = true;

        loadStats();
        updateStatsDisplay();
        setBoardTheme(state.boardTheme);
        initBoard();
        updateStatus();
        updateTimerDisplay();
        startTimer();

        if (state.gameMode === 'ai' && state.playerColor === 'white' && !state.gameOver) {
            setTimeout(aiMove, 500);
        }
    }

    function showSettings() {
        stopTimer();
        exitReplay();
        document.getElementById('game-panel').style.display = 'none';
        document.getElementById('settings-panel').style.display = 'block';
        resetGameState();
        initBoard();
    }

    function reset() {
        resetGameState();
        initBoard();
        if (state.timerMode !== 'off') { state.timerValue = parseInt(state.timerMode); updateTimerDisplay(); startTimer(); }
        if (state.gameMode === 'ai' && state.playerColor === 'white' && !state.gameOver) setTimeout(aiMove, 500);
    }

    function init() {
        const gameModeEl = document.getElementById('game-mode');
        if (gameModeEl) {
            gameModeEl.addEventListener('change', function() {
                const isAI = this.value === 'ai';
                const colorRow = document.getElementById('color-select-row');
                const diffRow = document.getElementById('difficulty-row');
                if (colorRow) colorRow.style.display = isAI ? 'flex' : 'none';
                if (diffRow) diffRow.style.display = isAI ? 'flex' : 'none';
            });
        }

        document.querySelectorAll('.theme-option').forEach(el => el.addEventListener('click', function() { setBoardTheme(this.dataset.theme); }));

        const replaySlider = document.getElementById('replay-slider');
        if (replaySlider) {
            replaySlider.addEventListener('input', function() {
                state.replayIndex = parseInt(this.value);
                renderBoard();
            });
        }

        document.getElementById('start-btn')?.addEventListener('click', start);
        document.getElementById('settings-btn')?.addEventListener('click', showSettings);
        document.getElementById('reset-btn')?.addEventListener('click', reset);
        document.getElementById('undo-btn')?.addEventListener('click', undo);
        document.getElementById('hint-btn')?.addEventListener('click', showHint);
        document.getElementById('sound-btn')?.addEventListener('click', toggleSound);
        document.getElementById('replay-btn')?.addEventListener('click', startReplay);
        document.getElementById('replay-prev-btn')?.addEventListener('click', replayPrev);
        document.getElementById('replay-next-btn')?.addEventListener('click', replayNext);
        document.getElementById('history-btn')?.addEventListener('click', toggleHistory);
        document.getElementById('play-btn')?.addEventListener('click', toggleAutoPlay);
        document.getElementById('exit-replay-btn')?.addEventListener('click', exitReplay);
        document.getElementById('clear-history-btn')?.addEventListener('click', clearHistory);

        loadStats();
    }

    return { start, showSettings, reset, undo, showHint, toggleSound, startReplay, replayPrev, replayNext, loadHistory, toggleHistory, toggleAutoPlay, clearHistory, exitReplay, init };
})();

document.addEventListener('DOMContentLoaded', Gomoku.init);
</script>
            
             <?php Content::pageFooter($this->options,$this) ?>
         </div>
        </article>
       </div>
       <!--评论-->
        <?php $this->need('component/comments.php') ?>
      </div>
         <?php echo WidgetContent::returnRightTriggerHtml() ?>
     </div>
     <!--文章右侧边栏开始-->
    <?php $this->need('component/sidebar.php'); ?>
     <!--文章右侧边栏结束-->
    </div>
   </main>
<?php echo Content::returnReadModeContent($this,$this->user->uid,$content); ?>

    <!-- footer -->
	<?php $this->need('component/footer.php'); ?>
  	<!-- / footer -->