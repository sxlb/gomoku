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
		<!--正文顶部的部件，如"返回首页"-->
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
    --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.1);
    --shadow-md: 0 4px 15px rgba(0, 0, 0, 0.15);
    --shadow-lg: 0 8px 30px rgba(0, 0, 0, 0.3);
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-success: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    --gradient-danger: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    --gradient-blue: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
    --gradient-green: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
    --gradient-orange: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
    --gradient-purple: linear-gradient(135deg, #9b59b6 0%, #8e44ad 100%);
    --gradient-teal: linear-gradient(135deg, #1abc9c 0%, #16a085 100%);
    --stone-size: 26px;
    --star-point-size: 5px;
    --star-point-large: 10px;
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
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
}

.gomoku-container .gomoku-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.gomoku-container .gomoku-btn:active:not(:disabled) { transform: translateY(0); }

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
.gomoku-container .gomoku-btn.history { background: var(--gradient-orange); }
.gomoku-container .gomoku-btn:disabled {
    background: #bdc3c7;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
}

.gomoku-board-wrapper { position: relative; display: inline-block; }

.gomoku-container .gomoku-board {
    display: inline-block;
    border: 4px solid var(--board-color, #5D4037);
    padding: 8px;
    border-radius: var(--board-border-radius);
    box-shadow: var(--shadow-lg);
    touch-action: manipulation;
    background: var(--board-bg, linear-gradient(135deg, #DEB887 0%, #D2B48C 100%));
}

.gomoku-board.theme-wood { --board-color: #5D4037; --board-bg: linear-gradient(135deg, #DEB887 0%, #D2B48C 100%); }
.gomoku-board.theme-modern { --board-color: #2c3e50; --board-bg: linear-gradient(135deg, #ecf0f1 0%, #bdc3c7 100%); }
.gomoku-board.theme-dark { --board-color: #1a1a2e; --board-bg: linear-gradient(135deg, #16213e 0%, #0f3460 100%); }
.gomoku-board.theme-green { --board-color: #27ae60; --board-bg: linear-gradient(135deg, #a8e063 0%, #56ab2f 100%); }

.gomoku-row { display: flex; }

.gomoku-cell {
    width: var(--board-cell-size);
    height: var(--board-cell-size);
    border: 1px solid rgba(0, 0, 0, 0.2);
    position: relative;
    cursor: pointer;
    background: transparent;
    transition: background 0.2s;
    box-sizing: border-box;
}

.gomoku-cell:hover:not(.occupied):not(.replay-mode) { background: rgba(255, 215, 0, 0.4); }
.gomoku-cell.occupied,
.gomoku-cell.replay-mode { cursor: not-allowed; }

.gomoku-cell::before {
    content: '';
    position: absolute;
    width: var(--star-point-size);
    height: var(--star-point-size);
    background: var(--board-color, rgba(101, 67, 33, 0.5));
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.6;
    pointer-events: none;
}

.gomoku-cell.star-point::before {
    width: var(--star-point-large);
    height: var(--star-point-large);
    opacity: 1;
}

.gomoku-cell.black::after,
.gomoku-cell.white::after {
    content: '';
    position: absolute;
    width: var(--stone-size);
    height: var(--stone-size);
    border-radius: 50%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    pointer-events: none;
}

.gomoku-cell.black::after {
    background: radial-gradient(circle at 35% 35%, #555, #000);
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}

.gomoku-cell.white::after {
    background: radial-gradient(circle at 35% 35%, #fff, #ddd);
    border: 1px solid #bbb;
    box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
}

.gomoku-cell.hint-cell::before {
    width: 14px !important;
    height: 14px !important;
    background: rgba(155, 89, 182, 0.8) !important;
    z-index: 1;
}

.gomoku-cell.last-move::after {
    box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.8), 2px 2px 5px rgba(0, 0, 0, 0.5);
}

.gomoku-cell.win { background: rgba(255, 215, 0, 0.6) !important; }

.gomoku-cell.win::after {
    box-shadow: 0 0 0 4px #FFD700, 2px 2px 5px rgba(0, 0, 0, 0.5);
}

.gomoku-cell.forbidden {
    background: rgba(255, 107, 107, 0.6) !important;
    animation: forbiddenPulse 0.5s ease-in-out;
}

@keyframes forbiddenPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2); }
}

.gomoku-cell.cursor::before {
    width: var(--stone-size);
    height: var(--stone-size);
    background: rgba(52, 152, 219, 0.4) !important;
    opacity: 1;
    border-radius: 50%;
}

.gomoku-container .gomoku-status {
    margin: 15px 0;
    padding: 15px;
    background: var(--gradient-primary);
    color: white;
    border-radius: var(--status-radius);
    font-size: 16px;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.gomoku-status.game-over { background: var(--gradient-success); }
.gomoku-status.draw { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }

.status-text { flex: 1; text-align: center; }

.sound-btn {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: white;
    padding: 8px 12px;
    border-radius: 20px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s;
    flex-shrink: 0;
}

.sound-btn:hover { background: rgba(255, 255, 255, 0.3); }

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
    flex-shrink: 0;
    min-width: 48px;
}

.timer-display.warning { animation: timerPulse 0.5s infinite; }

@keyframes timerPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.replay-controls { margin: 15px 0; display: flex; align-items: center; }

.replay-slider {
    flex: 1;
    height: 6px;
    -webkit-appearance: none;
    appearance: none;
    background: #dcdde1;
    border-radius: 3px;
    margin: 0 15px;
    cursor: pointer;
}

.replay-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 18px;
    height: 18px;
    background: #3498db;
    border-radius: 50%;
    cursor: pointer;
}

.replay-slider::-moz-range-thumb {
    width: 18px;
    height: 18px;
    background: #3498db;
    border-radius: 50%;
    cursor: pointer;
    border: none;
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
.history-result.win,
.history-result.black_win { background: #27ae60; color: white; }
.history-result.loss,
.history-result.white_win { background: #e74c3c; color: white; }
.history-result.draw { background: #f39c12; color: white; }
.history-moves { color: #7f8c8d; font-size: 12px; }
.history-empty { padding: 20px; text-align: center; color: #999; }

@media (max-width: 520px) {
    :root {
        --board-cell-size: 24px;
        --stone-size: 20px;
        --star-point-size: 4px;
        --star-point-large: 8px;
    }
    .setting-row { flex-direction: column; gap: 8px; }
    .gomoku-stats { gap: 10px; }
    .stat-item { padding: 8px 15px; min-width: 60px; }
    .stat-value { font-size: 18px; }
}
</style>

<div class="gomoku-container">
    <h2 style="text-align:center; margin-bottom:20px;">五子棋游戏</h2>

    <div class="gomoku-settings" id="settings-panel">
        <h3>&#9881;&#65039; 游戏设置</h3>
        <div class="setting-row">
            <span class="setting-label">游戏模式:</span>
            <select class="gomoku-select" id="game-mode">
                <option value="pvp">&#128101; 双人对战</option>
                <option value="ai">&#129302; 人机对战</option>
            </select>
        </div>
        <div class="setting-row" id="color-select-row">
            <span class="setting-label">玩家执棋:</span>
            <select class="gomoku-select" id="player-color">
                <option value="black">&#9899; 黑方（先手）</option>
                <option value="white">&#9898; 白方（后手）</option>
            </select>
        </div>
        <div class="setting-row" id="difficulty-row">
            <span class="setting-label">AI 难度:</span>
            <select class="gomoku-select" id="ai-difficulty">
                <option value="easy">&#127793; 简单</option>
                <option value="medium" selected>&#11088; 中等</option>
                <option value="hard">&#128142; 困难</option>
            </select>
        </div>
        <div class="setting-row">
            <span class="setting-label">计时模式:</span>
            <select class="gomoku-select" id="timer-mode">
                <option value="off">&#9208;&#65039; 关闭</option>
                <option value="30">&#9201;&#65039; 30秒/步</option>
                <option value="60">&#9201;&#65039; 60秒/步</option>
                <option value="total">&#9201;&#65039; 限时赛(每方5分钟)</option>
            </select>
        </div>
        <div class="setting-row" id="forbidden-row" style="display:none;">
            <span class="setting-label">禁手规则:</span>
            <select class="gomoku-select" id="forbidden-rule">
                <option value="off">关闭(自由模式)</option>
                <option value="on">开启(专业规则)</option>
            </select>
        </div>
        <div class="setting-row">
            <span class="setting-label">游戏类型:</span>
            <select class="gomoku-select" id="game-type">
                <option value="standard">标准模式</option>
                <option value="free">自由模式(无限悔棋+提示)</option>
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
            <button class="gomoku-btn start" id="start-btn">&#127918; 开始游戏</button>
        </div>
    </div>

    <div id="game-panel" style="display:none;">
        <div class="gomoku-stats">
            <div class="stat-item"><div class="stat-value win" id="win-count">0</div><div class="stat-label">胜利</div></div>
            <div class="stat-item"><div class="stat-value lose" id="lose-count">0</div><div class="stat-label">失败</div></div>
            <div class="stat-item"><div class="stat-value streak" id="streak-count">0</div><div class="stat-label">连胜</div></div>
        </div>

        <div class="gomoku-status" id="gomoku-status">
            <button class="sound-btn" id="sound-btn">&#128266;</button>
            <span class="status-text" id="status-text"><span id="current-player">黑方</span> 回合</span>
            <span class="timer-display" id="timer-display" style="display:none;">30</span>
        </div>

        <div class="gomoku-board-wrapper">
            <div class="gomoku-board theme-wood" id="gomoku-board" tabindex="0"></div>
        </div>

        <div class="replay-controls" id="replay-controls" style="display:none;">
            <button class="gomoku-btn replay" id="replay-prev-btn">&#9664;</button>
            <button class="gomoku-btn play" id="play-btn">&#9654;&#65039;</button>
            <input type="range" class="replay-slider" id="replay-slider" min="0" max="0" value="0">
            <button class="gomoku-btn replay" id="replay-next-btn">&#9654;</button>
            <button class="gomoku-btn reset" id="exit-replay-btn">&#10005;</button>
        </div>

        <div class="gomoku-controls">
            <button class="gomoku-btn" id="settings-btn">&#9881;&#65039; 设置</button>
            <button class="gomoku-btn hint" id="hint-btn" disabled>&#128161; 提示</button>
            <button class="gomoku-btn undo" id="undo-btn" disabled>&#8617;&#65039; 悔棋</button>
            <button class="gomoku-btn replay" id="replay-btn" disabled>&#128249; 回放</button>
            <button class="gomoku-btn history" id="history-btn">&#128220; 历史</button>
            <button class="gomoku-btn reset" id="reset-btn">&#128260; 重开</button>
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
(function() {
    'use strict';

    // ========== 常量模块 ==========
    var BOARD_SIZE = 15;
    var WIN_COUNT = 5;
    var CENTER = 7;
    var STAR_POINTS = [
        [3, 3], [3, 7], [3, 11],
        [7, 3], [7, 7], [7, 11],
        [11, 3], [11, 7], [11, 11]
    ];
    var DIRECTIONS = [
        [0, 1],
        [1, 0],
        [1, 1],
        [1, -1]
    ];
    var DIFFICULTY_CONFIG = {
        easy:   { depth: 1, candidates: 8,  searchCandidates: 6  },
        medium: { depth: 2, candidates: 12, searchCandidates: 8  },
        hard:   { depth: 3, candidates: 15, searchCandidates: 10 }
    };
    var STORAGE_KEYS = {
        STATS: 'gomokuStats',
        HISTORY: 'gomokuHistory'
    };
    var HISTORY_LIMIT = 10;
    var TIMER_WARNING_THRESHOLD = 5;
    var AI_DELAY = 300;
    var REPLAY_SPEED = 500;

    var PATTERNS = [
        { p: ['player', 'player', 'player', 'player', 'player'], s: 100000 },
        { p: [null, 'player', 'player', 'player', 'player', null], s: 50000 },
        { p: ['player', 'player', 'player', 'player', null], s: 5000 },
        { p: [null, 'player', 'player', 'player', 'player'], s: 5000 },
        { p: ['player', 'player', 'player', null, 'player'], s: 5000 },
        { p: ['player', 'player', null, 'player', 'player'], s: 5000 },
        { p: [null, null, 'player', 'player', 'player', null], s: 2000 },
        { p: [null, 'player', 'player', 'player', null, null], s: 2000 },
        { p: ['player', 'player', null, 'player', null], s: 500 },
        { p: ['player', null, 'player', 'player', null], s: 500 },
        { p: [null, 'player', 'player', null, 'player'], s: 500 },
        { p: ['player', 'player', null, null, 'player'], s: 500 },
        { p: [null, null, 'player', 'player', null], s: 100 },
        { p: [null, 'player', null, 'player', null], s: 50 },
        { p: ['player', null, null, null, 'player'], s: 50 }
    ];

    var DIFFICULTY_LABELS = { easy: '简单', medium: '中等', hard: '困难' };

    // ========== 工具函数模块 ==========
    var Utils = {
        inBounds: function(r, c) {
            return r >= 0 && r < BOARD_SIZE && c >= 0 && c < BOARD_SIZE;
        },

        isStarPoint: function(r, c) {
            for (var i = 0; i < STAR_POINTS.length; i++) {
                if (STAR_POINTS[i][0] === r && STAR_POINTS[i][1] === c) return true;
            }
            return false;
        },

        opponent: function(player) {
            return player === 'black' ? 'white' : 'black';
        },

        playerName: function(player) {
            return player === 'black' ? '黑方' : '白方';
        },

        safeStorage: {
            get: function(key) {
                try {
                    var item = localStorage.getItem(key);
                    return item ? JSON.parse(item) : null;
                } catch (e) {
                    console.warn('localStorage 读取失败:', e);
                    return null;
                }
            },
            set: function(key, value) {
                try {
                    localStorage.setItem(key, JSON.stringify(value));
                    return true;
                } catch (e) {
                    console.warn('localStorage 写入失败:', e);
                    return false;
                }
            },
            remove: function(key) {
                try {
                    localStorage.removeItem(key);
                    return true;
                } catch (e) {
                    console.warn('localStorage 删除失败:', e);
                    return false;
                }
            }
        },

        resultLabel: function(result) {
            switch (result) {
                case 'win': return '胜';
                case 'loss': return '负';
                case 'black_win': return '黑胜';
                case 'white_win': return '白胜';
                case 'draw': return '平';
                default: return '?';
            }
        },

        resultClass: function(result) {
            if (result === 'win' || result === 'black_win') return 'win';
            if (result === 'loss' || result === 'white_win') return 'loss';
            return 'draw';
        },

        modeLabel: function(game) {
            var mode = game.gameMode || game.mode;
            return mode === 'ai'
                ? 'AI(' + (game.difficultyText || DIFFICULTY_LABELS[game.difficulty || game.aiDifficulty] || '中等') + ')'
                : '双人对战';
        }
    };

    // ========== 音效模块 ==========
    var Sound = {
        ctx: null,
        enabled: true,

        init: function() {
            if (!this.ctx) {
                var Ctx = window.AudioContext || window.webkitAudioContext;
                if (Ctx) this.ctx = new Ctx();
            }
        },

        play: function(type) {
            if (!this.enabled) return;
            this.init();
            if (!this.ctx) return;
            var ctx = this.ctx;

            if (type === 'place') {
                this._playTone(800, 0.1, 0.3, 'sine');
            } else if (type === 'win') {
                var notes = [523, 659, 784, 1047];
                for (var i = 0; i < notes.length; i++) {
                    this._playTone(notes[i], 0.4, 0.2, 'sine', i * 0.15);
                }
            } else if (type === 'lose') {
                var loseNotes = [400, 350, 300, 250];
                for (var j = 0; j < loseNotes.length; j++) {
                    this._playTone(loseNotes[j], 0.4, 0.2, 'sine', j * 0.2);
                }
            }
        },

        _playTone: function(freq, duration, volume, type, delay) {
            if (!this.ctx) return;
            var ctx = this.ctx;
            var osc = ctx.createOscillator();
            var gain = ctx.createGain();
            osc.connect(gain);
            gain.connect(ctx.destination);
            osc.frequency.value = freq;
            osc.type = type || 'sine';

            var startTime = ctx.currentTime + (delay || 0);
            gain.gain.setValueAtTime(volume, startTime);
            gain.gain.exponentialRampToValueAtTime(0.01, startTime + duration);
            osc.start(startTime);
            osc.stop(startTime + duration);
        },

        toggle: function() {
            this.enabled = !this.enabled;
            return this.enabled;
        }
    };

    // ========== AI 模块 ==========
    var AI = {
        board: null,
        aiPlayer: 'white',
        humanPlayer: 'black',

        setBoard: function(board) {
            this.board = board;
        },

        setPlayers: function(ai, human) {
            this.aiPlayer = ai;
            this.humanPlayer = human;
        },

        findBestMove: function(depth, maxCandidates, moveCount) {
            if (moveCount === 0) return { row: CENTER, col: CENTER };

            var candidates = this._getCandidateMoves(maxCandidates);
            if (candidates.length === 0) return { row: CENTER, col: CENTER };

            var bestScore = -Infinity;
            var bestMoves = [];

            for (var i = 0; i < candidates.length; i++) {
                var move = candidates[i];
                this.board[move.row][move.col] = this.aiPlayer;
                var score = this._minimax(depth - 1, -Infinity, Infinity, false);
                this.board[move.row][move.col] = null;

                if (score > bestScore) {
                    bestScore = score;
                    bestMoves = [move];
                } else if (score === bestScore) {
                    bestMoves.push(move);
                }
            }

            return bestMoves[Math.floor(Math.random() * bestMoves.length)];
        },

        _getCandidateMoves: function(maxCandidates) {
            var moves = [];
            var checked = {};

            for (var i = 0; i < BOARD_SIZE; i++) {
                for (var j = 0; j < BOARD_SIZE; j++) {
                    if (this.board[i][j]) {
                        for (var di = -2; di <= 2; di++) {
                            for (var dj = -2; dj <= 2; dj++) {
                                var ni = i + di;
                                var nj = j + dj;
                                var key = ni + ',' + nj;
                                if (Utils.inBounds(ni, nj) && !this.board[ni][nj] && !checked[key]) {
                                    checked[key] = true;
                                    moves.push({ row: ni, col: nj });
                                }
                            }
                        }
                    }
                }
            }

            if (moves.length === 0) return [{ row: CENTER, col: CENTER }];

            var ai = this.aiPlayer;
            var self = this;
            moves.sort(function(a, b) {
                return self._evaluatePosition(b.row, b.col, ai) - self._evaluatePosition(a.row, a.col, ai);
            });

            return moves.slice(0, maxCandidates);
        },

        _minimax: function(depth, alpha, beta, isMaximizing) {
            if (depth === 0) return this._evaluateBoard();

            var config = DIFFICULTY_CONFIG[this.difficulty] || DIFFICULTY_CONFIG.medium;
            var candidates = this._getCandidateMoves(config.searchCandidates);

            if (isMaximizing) {
                var maxScore = -Infinity;
                for (var i = 0; i < candidates.length; i++) {
                    var move = candidates[i];
                    this.board[move.row][move.col] = this.aiPlayer;
                    maxScore = Math.max(maxScore, this._minimax(depth - 1, alpha, beta, false));
                    this.board[move.row][move.col] = null;
                    alpha = Math.max(alpha, maxScore);
                    if (beta <= alpha) break;
                }
                return maxScore;
            } else {
                var minScore = Infinity;
                for (var j = 0; j < candidates.length; j++) {
                    var move2 = candidates[j];
                    this.board[move2.row][move2.col] = this.humanPlayer;
                    minScore = Math.min(minScore, this._minimax(depth - 1, alpha, beta, true));
                    this.board[move2.row][move2.col] = null;
                    beta = Math.min(beta, minScore);
                    if (beta <= alpha) break;
                }
                return minScore;
            }
        },

        _evaluateBoard: function() {
            var score = 0;
            for (var i = 0; i < BOARD_SIZE; i++) {
                for (var j = 0; j < BOARD_SIZE; j++) {
                    if (this.board[i][j] === this.aiPlayer) {
                        score += this._evaluatePosition(i, j, this.aiPlayer);
                    } else if (this.board[i][j] === this.humanPlayer) {
                        score -= this._evaluatePosition(i, j, this.humanPlayer);
                    }
                }
            }
            return score;
        },

        _evaluatePosition: function(row, col, player) {
            var total = 0;
            for (var d = 0; d < DIRECTIONS.length; d++) {
                var dr = DIRECTIONS[d][0];
                var dc = DIRECTIONS[d][1];
                var line = this._getLine(row, col, dr, dc, player);
                total += this._evaluateLine(line);
            }
            return total;
        },

        _getLine: function(row, col, dr, dc, player) {
            var startR = row, startC = col;
            var endR = row, endC = col;

            while (Utils.inBounds(startR - dr, startC - dc) && this.board[startR - dr][startC - dc] === player) {
                startR -= dr;
                startC -= dc;
            }
            while (Utils.inBounds(endR + dr, endC + dc) && this.board[endR + dr][endC + dc] === player) {
                endR += dr;
                endC += dc;
            }

            var line = [];
            var r = startR, c = startC;
            while (true) {
                line.push({
                    row: r,
                    col: c,
                    value: (r === row && c === col) ? player : this.board[r][c]
                });
                if (r === endR && c === endC) break;
                r += dr;
                c += dc;
            }
            return line;
        },

        _evaluateLine: function(line) {
            var lineStr = '';
            for (var i = 0; i < line.length; i++) {
                lineStr += (line[i].value || 'null') + ',';
            }

            for (var p = 0; p < PATTERNS.length; p++) {
                var pattern = PATTERNS[p];
                var patternStr = pattern.p.join(',');
                if (lineStr.indexOf(patternStr) !== -1) return pattern.s;
            }

            var count = 0;
            for (var j = 0; j < line.length; j++) {
                if (line[j].value) count++;
            }
            return count * 3;
        }
    };

    // ========== 游戏状态模块 ==========
    var Game = {
        board: [],
        currentPlayer: 'black',
        gameOver: false,
        moveHistory: [],
        winCells: [],
        gameMode: 'pvp',
        playerColor: 'black',
        humanPlayer: 'black',
        aiDifficulty: 'medium',
        timerMode: 'off',
        boardTheme: 'wood',
        timerValue: 30,
        timerInterval: null,
        stats: { wins: 0, losses: 0, streak: 0 },
        replayMode: false,
        replayIndex: 0,
        autoPlay: false,
        autoPlayInterval: null,
        hintCell: null,
        cursorPos: { row: CENTER, col: CENTER },
        forbiddenEnabled: false,
        gameType: 'standard',
        gameGeneration: 0,
        freeModeEnabled: false,
        totalTimerBlack: 300,
        totalTimerWhite: 300,

        init: function() {
            if (this.autoPlayInterval) {
                clearInterval(this.autoPlayInterval);
                this.autoPlayInterval = null;
            }
            this.gameGeneration++;
            this.board = [];
            for (var i = 0; i < BOARD_SIZE; i++) {
                this.board.push(new Array(BOARD_SIZE).fill(null));
            }
            this.currentPlayer = 'black';
            this.gameOver = false;
            this.moveHistory = [];
            this.winCells = [];
            this.replayMode = false;
            this.replayIndex = 0;
            this.autoPlay = false;
            this.hintCell = null;
            this.cursorPos = { row: CENTER, col: CENTER };
            this.historySaved = false;
            this.timeoutLoser = null;
            this.totalTimerBlack = 300;
            this.totalTimerWhite = 300;
        },

        makeMove: function(row, col) {
            this.board[row][col] = this.currentPlayer;
            this.moveHistory.push({ row: row, col: col, player: this.currentPlayer });

            if (this._checkWin(row, col)) {
                this.gameOver = true;
                return 'win';
            }
            if (this._isBoardFull()) {
                this.gameOver = true;
                return 'draw';
            }

            this.currentPlayer = Utils.opponent(this.currentPlayer);
            return 'continue';
        },

        undoMove: function() {
            if (this.moveHistory.length === 0) return null;
            var last = this.moveHistory.pop();
            this.board[last.row][last.col] = null;
            this.winCells = [];
            this.gameOver = false;
            this.hintCell = null;
            this.currentPlayer = last.player;
            return last;
        },

        _checkWin: function(row, col) {
            var player = this.board[row][col];

            for (var d = 0; d < DIRECTIONS.length; d++) {
                var dr = DIRECTIONS[d][0];
                var dc = DIRECTIONS[d][1];
                var cells = [{ row: row, col: col }];
                this._countDirection(row, col, dr, dc, player, cells);
                this._countDirection(row, col, -dr, -dc, player, cells);
                if (cells.length >= WIN_COUNT) {
                    this.winCells = cells;
                    return true;
                }
            }
            return false;
        },

        _countDirection: function(row, col, dr, dc, player, cells) {
            var r = row + dr;
            var c = col + dc;
            while (Utils.inBounds(r, c) && this.board[r][c] === player) {
                cells.push({ row: r, col: c });
                r += dr;
                c += dc;
            }
        },

        _isBoardFull: function() {
            for (var i = 0; i < BOARD_SIZE; i++) {
                for (var j = 0; j < BOARD_SIZE; j++) {
                    if (!this.board[i][j]) return false;
                }
            }
            return true;
        },

        canPlay: function(row, col) {
            return !this.gameOver && !this.replayMode && Utils.inBounds(row, col) && !this.board[row][col];
        },

        _checkForbidden: function(row, col, player) {
            if (!this.forbiddenEnabled || player !== 'black') return false;

            this.board[row][col] = player;
            var forbidden = false;

            for (var d = 0; d < DIRECTIONS.length; d++) {
                var dr = DIRECTIONS[d][0];
                var dc = DIRECTIONS[d][1];
                var count = this._countLine(row, col, dr, dc, player);

                if (count.count >= 6) {
                    forbidden = true;
                    break;
                }

                if (count.count === 4 && (count.openEnds === 2 || count.openEnds === 1)) {
                    forbidden = true;
                    break;
                }

                if (count.count === 3 && count.openEnds === 2) {
                    forbidden = true;
                    break;
                }
            }

            this.board[row][col] = null;
            return forbidden;
        },

        _countLine: function(row, col, dr, dc, player) {
            var count = 1;
            var openEnds = 0;

            var r = row + dr;
            var c = col + dc;
            while (Utils.inBounds(r, c) && this.board[r][c] === player) {
                count++;
                r += dr;
                c += dc;
            }
            if (Utils.inBounds(r, c) && this.board[r][c] === null) {
                openEnds++;
            }

            r = row - dr;
            c = col - dc;
            while (Utils.inBounds(r, c) && this.board[r][c] === player) {
                count++;
                r -= dr;
                c -= dc;
            }
            if (Utils.inBounds(r, c) && this.board[r][c] === null) {
                openEnds++;
            }

            return { count: count, openEnds: openEnds };
        }
    };

    // ========== UI 渲染模块 ==========
    var UI = {
        els: {},
        cellEls: [],

        cacheElements: function() {
            var ids = [
                'settings-panel', 'game-panel', 'gomoku-board', 'gomoku-status',
                'status-text', 'current-player', 'sound-btn', 'timer-display',
                'start-btn', 'settings-btn', 'reset-btn', 'undo-btn', 'hint-btn',
                'replay-btn', 'history-btn', 'replay-controls', 'replay-slider',
                'replay-prev-btn', 'replay-next-btn', 'play-btn', 'exit-replay-btn',
                'win-count', 'lose-count', 'streak-count', 'history-list',
                'history-items', 'clear-history-btn', 'game-mode', 'player-color',
                'ai-difficulty', 'timer-mode', 'color-select-row', 'difficulty-row',
                'forbidden-row', 'forbidden-rule', 'game-type'
            ];
            for (var i = 0; i < ids.length; i++) {
                var el = document.getElementById(ids[i]);
                if (el) this.els[ids[i]] = el;
            }
        },

        buildBoard: function() {
            var boardEl = this.els['gomoku-board'];
            if (!boardEl) return;
            boardEl.innerHTML = '';
            this.cellEls = [];

            for (var i = 0; i < BOARD_SIZE; i++) {
                var rowEl = document.createElement('div');
                rowEl.className = 'gomoku-row';
                var rowCells = [];

                for (var j = 0; j < BOARD_SIZE; j++) {
                    var cell = document.createElement('div');
                    cell.className = 'gomoku-cell';
                    cell.dataset.row = i;
                    cell.dataset.col = j;

                    if (Utils.isStarPoint(i, j)) cell.classList.add('star-point');

                    rowCells.push(cell);
                    rowEl.appendChild(cell);
                }
                this.cellEls.push(rowCells);
                boardEl.appendChild(rowEl);
            }
        },

        updateBoard: function() {
            if (!this.cellEls.length) return;

            var replayMode = Game.replayMode;
            var board = Game.board;
            var history = Game.moveHistory;
            var replayIndex = Game.replayIndex;
            var winCells = Game.winCells;
            var hintCell = Game.hintCell;
            var cursorPos = Game.cursorPos;

            for (var i = 0; i < BOARD_SIZE; i++) {
                for (var j = 0; j < BOARD_SIZE; j++) {
                    var cell = this.cellEls[i][j];
                    cell.classList.remove('black', 'white', 'occupied', 'win', 'last-move', 'hint-cell', 'replay-mode', 'cursor');

                    if (replayMode) {
                        cell.classList.add('replay-mode');
                        var lastMoveIdx = -1;
                        for (var k = 0; k < replayIndex; k++) {
                            if (history[k].row === i && history[k].col === j) {
                                cell.classList.add(history[k].player);
                                lastMoveIdx = k;
                            }
                        }
                        if (lastMoveIdx === replayIndex - 1) cell.classList.add('last-move');
                    } else {
                        if (board[i][j]) {
                            cell.classList.add(board[i][j], 'occupied');
                        }
                        if (hintCell && hintCell.row === i && hintCell.col === j) {
                            cell.classList.add('hint-cell');
                        }
                        if (history.length > 0) {
                            var last = history[history.length - 1];
                            if (last.row === i && last.col === j) cell.classList.add('last-move');
                        }
                    }

                    for (var w = 0; w < winCells.length; w++) {
                        if (winCells[w].row === i && winCells[w].col === j) {
                            cell.classList.add('win');
                            break;
                        }
                    }

                    if (!replayMode && !Game.gameOver && cursorPos.row === i && cursorPos.col === j) {
                        if (!board[i][j]) cell.classList.add('cursor');
                    }
                }
            }
        },

        updateStatus: function() {
            var statusEl = this.els['gomoku-status'];
            var textEl = this.els['status-text'];
            if (!statusEl || !textEl) return;

            statusEl.classList.remove('game-over', 'draw');

            if (Game.gameOver) {
                var lastPlayer = Game.moveHistory.length > 0
                    ? Game.moveHistory[Game.moveHistory.length - 1].player
                    : null;

                var isDraw = Game.winCells.length === 0;
                if (isDraw) {
                    textEl.innerHTML = '&#129309; 平局！';
                    statusEl.classList.add('draw');
                } else if (Game.timeoutLoser) {
                    var timeoutWinner = Utils.opponent(Game.timeoutLoser);
                    var winnerName = Utils.playerName(timeoutWinner);
                    textEl.innerHTML = '<span style="color:#ff6b6b">&#9201;&#65039; 超时！</span> ' + winnerName + ' 获胜！';
                    statusEl.classList.add('game-over');
                } else {
                    var winner = Utils.playerName(lastPlayer);
                    textEl.innerHTML = '<span style="font-size:20px">&#127881;</span> ' + winner + ' 获胜！';
                    statusEl.classList.add('game-over');
                }
            } else if (Game.replayMode) {
                var modeText = Utils.modeLabel(Game);
                textEl.innerHTML = '&#128249; 回放: ' + modeText + ' - ' + Game.moveHistory.length + '手';
            } else {
                var playerName = Utils.playerName(Game.currentPlayer);
                var isAITurn = Game.gameMode === 'ai' && Game.currentPlayer !== Game.humanPlayer;

                if (isAITurn) {
                    textEl.innerHTML = '<span class="thinking">&#129302; AI 思考中...</span>';
                } else {
                    var tag = Game.gameMode === 'ai' ? '(你)' : '';
                    textEl.innerHTML = '<span id="current-player">' + playerName + '</span> ' + tag + ' 回合';
                }
            }

            this.updateSoundButton();
            this.updateTimerDisplay();
        },

        updateSoundButton: function() {
            var btn = this.els['sound-btn'];
            if (btn) btn.textContent = Sound.enabled ? '\uD83D\uDD0A' : '\uD83D\uDD07';
        },

        updateTimerDisplay: function() {
            var el = this.els['timer-display'];
            if (!el) return;
            if (Game.timerMode === 'off') {
                el.style.display = 'none';
            } else {
                el.style.display = 'inline-block';
                if (Game.timerMode === 'total') {
                    el.textContent = Timer.formatTime(Game.timerValue);
                    el.classList.toggle('warning', Game.timerValue <= 30);
                } else {
                    el.textContent = Game.timerValue;
                    el.classList.toggle('warning', Game.timerValue <= TIMER_WARNING_THRESHOLD);
                }
            }
        },

        updateStats: function() {
            if (this.els['win-count']) this.els['win-count'].textContent = Game.stats.wins;
            if (this.els['lose-count']) this.els['lose-count'].textContent = Game.stats.losses;
            if (this.els['streak-count']) this.els['streak-count'].textContent = Game.stats.streak;
        },

        updateControls: function() {
            var moveCount = Game.moveHistory.length;
            var replayMode = Game.replayMode;
            var gameOver = Game.gameOver;
            var freeMode = Game.freeModeEnabled;

            if (this.els['undo-btn']) {
                // 自由模式：游戏结束后也可以悔棋
                var undoDisabled = moveCount === 0 || replayMode || (!freeMode && gameOver);
                this.els['undo-btn'].disabled = undoDisabled;
            }
            if (this.els['replay-btn']) {
                this.els['replay-btn'].disabled = moveCount < 2 || replayMode || !gameOver;
            }
            if (this.els['hint-btn']) {
                var hintDisabled = true;
                if (Game.gameMode === 'ai' && !replayMode) {
                    // 自由模式：任何时候都可以提示
                    if (freeMode || !gameOver) {
                        hintDisabled = Game.currentPlayer !== Game.humanPlayer;
                    }
                }
                this.els['hint-btn'].disabled = hintDisabled;
            }
        },

        setTheme: function(theme) {
            Game.boardTheme = theme;
            var boardEl = this.els['gomoku-board'];
            if (boardEl) boardEl.className = 'gomoku-board theme-' + theme;

            var options = document.querySelectorAll('.theme-option');
            for (var i = 0; i < options.length; i++) {
                options[i].classList.toggle('active', options[i].dataset.theme === theme);
            }
        },

        buildHistoryItem: function(game, index) {
            return '<div class="history-item" data-index="' + index + '">' +
                '<span class="history-date">' + game.date + '</span>' +
                '<span class="history-mode">' + Utils.modeLabel(game) + '</span>' +
                '<span class="history-result ' + Utils.resultClass(game.result) + '">' + Utils.resultLabel(game.result) + '</span>' +
                '<span class="history-moves">' + game.moveCount + '手</span>' +
            '</div>';
        },

        updateHistoryList: function(games) {
            var el = this.els['history-items'];
            if (!el) return;

            if (!games || games.length === 0) {
                el.innerHTML = '<div class="history-empty">暂无历史记录</div>';
                return;
            }

            var html = '';
            for (var i = 0; i < games.length; i++) {
                html += this.buildHistoryItem(games[i], i);
            }
            el.innerHTML = html;
        },

        updateReplaySlider: function() {
            var slider = this.els['replay-slider'];
            if (!slider) return;
            slider.max = Game.moveHistory.length;
            slider.value = Game.replayIndex;
        },

        showSettings: function(show) {
            if (this.els['settings-panel']) this.els['settings-panel'].style.display = show ? 'block' : 'none';
            if (this.els['game-panel']) this.els['game-panel'].style.display = show ? 'none' : 'block';
        },

        showReplayControls: function(show) {
            if (this.els['replay-controls']) this.els['replay-controls'].style.display = show ? 'flex' : 'none';
        },

        showHistory: function(show) {
            if (this.els['history-list']) this.els['history-list'].style.display = show ? 'block' : 'none';
        },

        setPlayButton: function(playing) {
            if (this.els['play-btn']) this.els['play-btn'].textContent = playing ? '\u23F8\uFE0F' : '\u25B6\uFE0F';
        },

        setColorSelectRow: function(visible) {
            if (this.els['color-select-row']) this.els['color-select-row'].style.display = visible ? 'flex' : 'none';
            if (this.els['difficulty-row']) this.els['difficulty-row'].style.display = visible ? 'flex' : 'none';
        },

        showForbiddenWarning: function(row, col) {
            var cell = this.cellEls[row][col];
            if (!cell) return;

            cell.classList.add('forbidden');
            setTimeout(function() {
                cell.classList.remove('forbidden');
            }, 1000);

            var textEl = this.els['status-text'];
            if (textEl) {
                textEl.innerHTML = '<span style="color:#ff6b6b">&#9888; 禁手！此位置不允许落子</span>';
                setTimeout(function() {
                    UI.updateStatus();
                }, 1000);
            }
        }
    };

    // ========== 历史记录模块 ==========
    var History = {
        load: function() {
            return Utils.safeStorage.get(STORAGE_KEYS.HISTORY) || [];
        },

        save: function(result) {
            var games = this.load();
            var difficultyText = DIFFICULTY_LABELS[Game.aiDifficulty] || '中等';

            games.unshift({
                mode: Game.gameMode,
                difficulty: Game.aiDifficulty,
                player: Game.playerColor,
                result: result,
                moves: Game.moveHistory.slice(),
                date: new Date().toLocaleString(),
                moveCount: Game.moveHistory.length,
                difficultyText: difficultyText,
                gameType: Game.gameType,
                timerMode: Game.timerMode
            });

            if (games.length > HISTORY_LIMIT) games.pop();
            Utils.safeStorage.set(STORAGE_KEYS.HISTORY, games);
            return games;
        },

        clear: function() {
            Utils.safeStorage.remove(STORAGE_KEYS.HISTORY);
        },

        determineResult: function() {
            if (!Game.gameOver) return null;

            // 处理超时情况
            if (Game.timeoutLoser) {
                var winner = Utils.opponent(Game.timeoutLoser);
                if (Game.gameMode === 'pvp') {
                    return winner === 'black' ? 'black_win' : 'white_win';
                } else {
                    return winner === Game.humanPlayer ? 'win' : 'loss';
                }
            }

            if (Game.winCells.length === 0) return 'draw';

            var winner = Game.moveHistory[Game.moveHistory.length - 1].player;
            if (Game.gameMode === 'pvp') {
                return winner === 'black' ? 'black_win' : 'white_win';
            } else {
                return winner === Game.humanPlayer ? 'win' : 'loss';
            }
        }
    };

    // ========== 统计模块 ==========
    var Stats = {
        load: function() {
            var saved = Utils.safeStorage.get(STORAGE_KEYS.STATS);
            if (saved) Game.stats = saved;
        },

        save: function() {
            Utils.safeStorage.set(STORAGE_KEYS.STATS, Game.stats);
        },

        recordWin: function() {
            Game.stats.wins++;
            Game.stats.streak++;
            this.save();
        },

        recordLoss: function() {
            Game.stats.losses++;
            Game.stats.streak = 0;
            this.save();
        },

        onGameEnd: function(result) {
            if (Game.gameMode !== 'ai') return;
            if (result === 'win') this.recordWin();
            else if (result === 'loss') this.recordLoss();
        }
    };

    // ========== 计时器模块 ==========
    var Timer = {
        start: function() {
            this.stop();
            if (Game.timerMode === 'off') return;

            // 限时赛模式：初始化总时间
            if (Game.timerMode === 'total') {
                Game.totalTimerBlack = 300; // 5分钟
                Game.totalTimerWhite = 300;
                Game.timerValue = 300;
            } else {
                // 每步计时模式
                Game.timerValue = parseInt(Game.timerMode, 10);
            }

            UI.updateTimerDisplay();

            var self = this;
            Game.timerInterval = setInterval(function() {
                if (Game.timerMode === 'total') {
                    // 限时赛：减少当前玩家的总时间
                    if (Game.currentPlayer === 'black') {
                        Game.totalTimerBlack--;
                        Game.timerValue = Game.totalTimerBlack;
                    } else {
                        Game.totalTimerWhite--;
                        Game.timerValue = Game.totalTimerWhite;
                    }

                    if (Game.timerValue <= 0) {
                        self.stop();
                        self._onTimeout();
                        return;
                    }
                } else {
                    // 每步计时
                    Game.timerValue--;
                    if (Game.timerValue <= 0) {
                        self.stop();
                        self._onTimeout();
                        return;
                    }
                }

                UI.updateTimerDisplay();
            }, 1000);
        },

        stop: function() {
            if (Game.timerInterval) {
                clearInterval(Game.timerInterval);
                Game.timerInterval = null;
            }
        },

        reset: function() {
            if (Game.timerMode === 'off') return;

            // 限时赛模式不重置，继续计时
            if (Game.timerMode === 'total') {
                return;
            }

            // 每步计时模式：重置计时器
            this.stop();
            this.start();
        },

        // 恢复计时器（不重置时间），用于悔棋后继续计时
        resume: function() {
            if (Game.timerMode === 'off') return;
            this.stop();

            // 限时赛模式：同步当前玩家的剩余时间到显示值
            if (Game.timerMode === 'total') {
                Game.timerValue = Game.currentPlayer === 'black'
                    ? Game.totalTimerBlack
                    : Game.totalTimerWhite;
            }

            UI.updateTimerDisplay();

            var self = this;
            Game.timerInterval = setInterval(function() {
                if (Game.timerMode === 'total') {
                    if (Game.currentPlayer === 'black') {
                        Game.totalTimerBlack--;
                        Game.timerValue = Game.totalTimerBlack;
                    } else {
                        Game.totalTimerWhite--;
                        Game.timerValue = Game.totalTimerWhite;
                    }

                    if (Game.timerValue <= 0) {
                        self.stop();
                        self._onTimeout();
                        return;
                    }
                } else {
                    Game.timerValue--;
                    if (Game.timerValue <= 0) {
                        self.stop();
                        self._onTimeout();
                        return;
                    }
                }

                UI.updateTimerDisplay();
            }, 1000);
        },

        _onTimeout: function() {
            if (Game.gameOver) return;

            Game.gameOver = true;
            Game.timeoutLoser = Game.currentPlayer;
            Controller._handleGameEnd('timeout');
        },

        formatTime: function(seconds) {
            if (seconds < 0) seconds = 0;
            var mins = Math.floor(seconds / 60);
            var secs = seconds % 60;
            return mins + ':' + (secs < 10 ? '0' : '') + secs;
        }
    };

    // ========== 回放模块 ==========
    var Replay = {
        _savedSettings: null,

        start: function() {
            if (Game.moveHistory.length < 2) return;

            if (!this._savedSettings) {
                this._savedSettings = {
                    gameMode: Game.gameMode,
                    aiDifficulty: Game.aiDifficulty,
                    playerColor: Game.playerColor,
                    timerMode: Game.timerMode,
                    gameType: Game.gameType,
                    freeModeEnabled: Game.freeModeEnabled,
                    forbiddenEnabled: Game.forbiddenEnabled
                };
            }

            if (Game.gameOver && !Game.historySaved) {
                History.save(History.determineResult());
                Game.historySaved = true;
            }

            Game.replayMode = true;
            Game.replayIndex = 0;
            Game.autoPlay = false;
            this._stopAutoPlay();

            UI.showReplayControls(true);
            UI.updateReplaySlider();
            UI.setPlayButton(false);
            UI.updateStatus();
            UI.updateBoard();
            UI.updateControls();
        },

        exit: function() {
            this._restoreSettings();
            Game.replayMode = false;
            Game.replayIndex = 0;
            Game.autoPlay = false;
            this._stopAutoPlay();
            UI.showReplayControls(false);
            UI.showHistory(false);
            Controller.resetGame();
        },

        _restoreSettings: function() {
            if (this._savedSettings) {
                Game.gameMode = this._savedSettings.gameMode;
                Game.aiDifficulty = this._savedSettings.aiDifficulty;
                Game.playerColor = this._savedSettings.playerColor;
                Game.timerMode = this._savedSettings.timerMode;
                Game.gameType = this._savedSettings.gameType;
                Game.freeModeEnabled = this._savedSettings.freeModeEnabled;
                Game.forbiddenEnabled = this._savedSettings.forbiddenEnabled;
                this._savedSettings = null;
            }
        },

        prev: function() {
            if (Game.replayIndex > 0) {
                Game.replayIndex--;
                UI.updateReplaySlider();
                UI.updateBoard();
            }
        },

        next: function() {
            if (Game.replayIndex < Game.moveHistory.length) {
                Game.replayIndex++;
                UI.updateReplaySlider();
                UI.updateBoard();
            }
        },

        seek: function(index) {
            Game.replayIndex = Math.max(0, Math.min(Game.moveHistory.length, index));
            UI.updateBoard();
        },

        toggleAuto: function() {
            Game.autoPlay = !Game.autoPlay;
            if (Game.autoPlay) {
                if (Game.replayIndex >= Game.moveHistory.length) {
                    Game.replayIndex = 0;
                }
                UI.setPlayButton(true);
                this._startAutoPlay();
            } else {
                UI.setPlayButton(false);
                this._stopAutoPlay();
            }
        },

        _startAutoPlay: function() {
            if (Game.autoPlayInterval) return;
            var self = this;
            Game.autoPlayInterval = setInterval(function() {
                if (Game.replayIndex < Game.moveHistory.length) {
                    Game.replayIndex++;
                    UI.updateReplaySlider();
                    UI.updateBoard();
                } else {
                    Game.autoPlay = false;
                    UI.setPlayButton(false);
                    self._stopAutoPlay();
                }
            }, REPLAY_SPEED);
        },

        _stopAutoPlay: function() {
            if (Game.autoPlayInterval) {
                clearInterval(Game.autoPlayInterval);
                Game.autoPlayInterval = null;
            }
        },

        loadGame: function(index) {
            var games = History.load();
            var game = games[index];
            if (!game) return;

            if (!this._savedSettings) {
                this._savedSettings = {
                    gameMode: Game.gameMode,
                    aiDifficulty: Game.aiDifficulty,
                    playerColor: Game.playerColor,
                    timerMode: Game.timerMode,
                    gameType: Game.gameType,
                    freeModeEnabled: Game.freeModeEnabled,
                    forbiddenEnabled: Game.forbiddenEnabled
                };
            }

            Game.moveHistory = game.moves.slice();
            Game.replayMode = true;
            Game.replayIndex = 0;
            Game.autoPlay = false;
            this._stopAutoPlay();
            Game.gameMode = game.mode;
            Game.aiDifficulty = game.difficulty;
            if (game.gameType) Game.gameType = game.gameType;

            UI.showReplayControls(true);
            UI.updateReplaySlider();
            UI.setPlayButton(false);

            var resultClass = Utils.resultClass(game.result);
            var resultLabel = Utils.resultLabel(game.result);
            var modeText = Utils.modeLabel(game);

            var textEl = UI.els['status-text'];
            if (textEl) {
                textEl.innerHTML = '&#128249; ' + game.date + ' - ' + modeText +
                    ' - <span class="history-result ' + resultClass + '" style="padding:2px 8px;border-radius:10px;">' + resultLabel + '</span>' +
                    ' - ' + game.moveCount + '手';
            }
            UI.showHistory(false);
            UI.updateBoard();
        }
    };

    // ========== 主控制器 ==========
    var Controller = {
        init: function() {
            UI.cacheElements();
            UI.buildBoard();
            Stats.load();
            UI.updateStats();
            this._bindEvents();
            this._initAIBoard();
            this._initSettingsState();
        },

        _initSettingsState: function() {
            var gameModeEl = UI.els['game-mode'];
            if (gameModeEl) {
                var isAI = gameModeEl.value === 'ai';
                UI.setColorSelectRow(isAI);
            }
        },

        _initAIBoard: function() {
            AI.setBoard(Game.board);
        },

        _bindEvents: function() {
            var boardEl = UI.els['gomoku-board'];
            if (boardEl) {
                boardEl.addEventListener('click', this._onBoardClick.bind(this));
                boardEl.addEventListener('keydown', this._onKeyDown.bind(this));
            }

            var gameModeEl = UI.els['game-mode'];
            if (gameModeEl) {
                gameModeEl.addEventListener('change', this._onGameModeChange.bind(this));
            }

            var themeOptions = document.querySelectorAll('.theme-option');
            for (var i = 0; i < themeOptions.length; i++) {
                themeOptions[i].addEventListener('click', function(e) {
                    UI.setTheme(e.currentTarget.dataset.theme);
                });
            }

            var replaySlider = UI.els['replay-slider'];
            if (replaySlider) {
                replaySlider.addEventListener('input', this._onReplaySlider.bind(this));
            }

            var historyItems = UI.els['history-items'];
            if (historyItems) {
                historyItems.addEventListener('click', this._onHistoryClick.bind(this));
            }

            this._on('start-btn', 'click', this.startGame.bind(this));
            this._on('settings-btn', 'click', this.showSettings.bind(this));
            this._on('reset-btn', 'click', this.resetGame.bind(this));
            this._on('undo-btn', 'click', this.undo.bind(this));
            this._on('hint-btn', 'click', this.showHint.bind(this));
            this._on('sound-btn', 'click', this.toggleSound.bind(this));
            this._on('replay-btn', 'click', Replay.start.bind(Replay));
            this._on('replay-prev-btn', 'click', Replay.prev.bind(Replay));
            this._on('replay-next-btn', 'click', Replay.next.bind(Replay));
            this._on('play-btn', 'click', Replay.toggleAuto.bind(Replay));
            this._on('exit-replay-btn', 'click', Replay.exit.bind(Replay));
            this._on('history-btn', 'click', this.toggleHistory.bind(this));
            this._on('clear-history-btn', 'click', this.clearHistory.bind(this));
        },

        _on: function(id, event, handler) {
            var el = UI.els[id];
            if (el) el.addEventListener(event, handler);
        },

        _onBoardClick: function(e) {
            var cell = e.target.closest('.gomoku-cell');
            if (!cell) return;
            var row = parseInt(cell.dataset.row, 10);
            var col = parseInt(cell.dataset.col, 10);
            this.playerMove(row, col);
        },

        _onKeyDown: function(e) {
            if (Game.replayMode) {
                switch (e.key) {
                    case 'ArrowLeft':
                    case 'ArrowUp':
                        e.preventDefault();
                        Replay.prev();
                        break;
                    case 'ArrowRight':
                    case 'ArrowDown':
                        e.preventDefault();
                        Replay.next();
                        break;
                    case ' ':
                        e.preventDefault();
                        Replay.toggleAuto();
                        break;
                    case 'Escape':
                        e.preventDefault();
                        Replay.exit();
                        break;
                }
                return;
            }

            if (Game.gameOver) {
                if (e.key === 'r' || e.key === 'R') {
                    e.preventDefault();
                    this.resetGame();
                }
                return;
            }

            var cursor = Game.cursorPos;
            var moved = false;

            switch (e.key) {
                case 'ArrowUp':
                    e.preventDefault();
                    if (cursor.row > 0) { cursor.row--; moved = true; }
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    if (cursor.row < BOARD_SIZE - 1) { cursor.row++; moved = true; }
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    if (cursor.col > 0) { cursor.col--; moved = true; }
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    if (cursor.col < BOARD_SIZE - 1) { cursor.col++; moved = true; }
                    break;
                case 'Enter':
                case ' ':
                    e.preventDefault();
                    if (Game.canPlay(cursor.row, cursor.col) && this._isPlayerTurn()) {
                        this.playerMove(cursor.row, cursor.col);
                    }
                    return;
                case 'h':
                case 'H':
                    e.preventDefault();
                    if (Game.gameMode === 'ai' && Game.currentPlayer === Game.humanPlayer) {
                        this.showHint();
                    }
                    return;
                case 'u':
                case 'U':
                    e.preventDefault();
                    this.undo();
                    return;
                case 'r':
                case 'R':
                    e.preventDefault();
                    this.resetGame();
                    return;
            }

            if (moved) UI.updateBoard();
        },

        _isPlayerTurn: function() {
            if (Game.gameMode === 'pvp') return true;
            return Game.currentPlayer === Game.humanPlayer;
        },

        _onGameModeChange: function(e) {
            var isAI = e.target.value === 'ai';
            UI.setColorSelectRow(isAI);
            if (UI.els['forbidden-row']) {
                UI.els['forbidden-row'].style.display = isAI ? 'flex' : 'none';
            }
        },

        _onReplaySlider: function(e) {
            Replay.seek(parseInt(e.target.value, 10));
        },

        _onHistoryClick: function(e) {
            var item = e.target.closest('.history-item');
            if (!item) return;
            var index = parseInt(item.dataset.index, 10);
            Replay.loadGame(index);
        },

        startGame: function() {
            Game.gameMode = UI.els['game-mode'] ? UI.els['game-mode'].value : 'pvp';
            Game.playerColor = UI.els['player-color'] ? UI.els['player-color'].value : 'black';
            Game.humanPlayer = Game.playerColor;
            Game.aiDifficulty = UI.els['ai-difficulty'] ? UI.els['ai-difficulty'].value : 'medium';
            Game.timerMode = UI.els['timer-mode'] ? UI.els['timer-mode'].value : 'off';

            var forbiddenEl = UI.els['forbidden-rule'];
            Game.forbiddenEnabled = forbiddenEl && forbiddenEl.value === 'on';

            var gameTypeEl = UI.els['game-type'];
            Game.gameType = gameTypeEl ? gameTypeEl.value : 'standard';
            Game.freeModeEnabled = Game.gameType === 'free';

            var activeTheme = document.querySelector('.theme-option.active');
            Game.boardTheme = activeTheme ? activeTheme.dataset.theme : 'wood';

            Game.init();
            this._initAIBoard();
            AI.setPlayers(Utils.opponent(Game.humanPlayer), Game.humanPlayer);

            UI.showSettings(false);
            UI.showReplayControls(false);
            UI.showHistory(false);
            UI.setTheme(Game.boardTheme);

            Stats.load();
            UI.updateStats();
            UI.updateStatus();
            UI.updateBoard();
            UI.updateControls();

            if (Game.timerMode !== 'off') Timer.start();

            if (Game.gameMode === 'ai' && Game.playerColor === 'white') {
                var self = this;
                var gen = Game.gameGeneration;
                setTimeout(function() {
                    if (Game.gameGeneration !== gen) return;
                    self.aiMove();
                }, AI_DELAY + 200);
            }
        },

        showSettings: function() {
            Timer.stop();
            if (Game.replayMode) {
                Replay._restoreSettings();
                Game.replayMode = false;
                Game.replayIndex = 0;
                Game.autoPlay = false;
                Replay._stopAutoPlay();
                UI.showReplayControls(false);
                UI.showHistory(false);
            }
            UI.showSettings(true);
            Game.init();
            this._initAIBoard();
            UI.updateBoard();
            this._initSettingsState();
        },

        resetGame: function() {
            if (Game.replayMode) {
                Replay._restoreSettings();
            }
            Game.init();
            this._initAIBoard();
            AI.setPlayers(Utils.opponent(Game.humanPlayer), Game.humanPlayer);

            UI.showReplayControls(false);
            UI.showHistory(false);
            UI.updateStatus();
            UI.updateBoard();
            UI.updateControls();

            Timer.stop();
            if (Game.timerMode !== 'off') Timer.start();

            if (Game.gameMode === 'ai' && Game.playerColor === 'white') {
                var self = this;
                var gen = Game.gameGeneration;
                setTimeout(function() {
                    if (Game.gameGeneration !== gen) return;
                    self.aiMove();
                }, AI_DELAY + 200);
            }
        },

        playerMove: function(row, col) {
            if (Game.replayMode) return;
            if (Game.gameOver) return;
            if (Game.gameMode === 'ai' && Game.currentPlayer !== Game.humanPlayer) return;
            if (!Game.canPlay(row, col)) return;

            // 检查禁手
            if (Game._checkForbidden(row, col, Game.currentPlayer)) {
                UI.showForbiddenWarning(row, col);
                return;
            }

            Game.hintCell = null;
            this._makeMove(row, col);

            if (Game.gameMode === 'ai' && !Game.gameOver) {
                var self = this;
                var gen = Game.gameGeneration;
                setTimeout(function() {
                    if (Game.gameGeneration !== gen) return;
                    self.aiMove();
                }, AI_DELAY);
            }
        },

        aiMove: function() {
            if (Game.gameOver) return;
            if (Game.gameMode !== 'ai') return;
            if (Game.currentPlayer === Game.humanPlayer) return;

            var config = DIFFICULTY_CONFIG[Game.aiDifficulty];
            var move = AI.findBestMove(config.depth, config.candidates, Game.moveHistory.length);
            this._makeMove(move.row, move.col);
        },

        _makeMove: function(row, col) {
            var result = Game.makeMove(row, col);
            Sound.play('place');
            Timer.reset();

            UI.updateBoard();
            UI.updateControls();

            if (result === 'win' || result === 'draw') {
                this._handleGameEnd(result);
            } else {
                UI.updateStatus();
            }
        },

        _handleGameEnd: function(result) {
            Timer.stop();

            var gameResult = 'draw';
            if (result === 'win') {
                var winner = Game.moveHistory[Game.moveHistory.length - 1].player;
                if (Game.gameMode === 'ai') {
                    gameResult = winner === Game.humanPlayer ? 'win' : 'loss';
                    Sound.play(gameResult === 'win' ? 'win' : 'lose');
                    Stats.onGameEnd(gameResult);
                    UI.updateStats();
                } else {
                    gameResult = winner === 'black' ? 'black_win' : 'white_win';
                    Sound.play('win');
                }
            } else if (result === 'timeout') {
                var loser = Game.timeoutLoser;
                if (Game.gameMode === 'ai') {
                    gameResult = loser === Game.humanPlayer ? 'loss' : 'win';
                    Sound.play(gameResult === 'win' ? 'win' : 'lose');
                    Stats.onGameEnd(gameResult);
                    UI.updateStats();
                } else {
                    gameResult = loser === 'black' ? 'white_win' : 'black_win';
                    Sound.play('win');
                }
            }

            if (!Game.historySaved) {
                History.save(gameResult);
                Game.historySaved = true;
            }

            UI.updateStatus();
            UI.updateBoard();
            UI.updateControls();
        },

        undo: function() {
            if (Game.moveHistory.length === 0) return;
            if (Game.replayMode) return;

            // 自由模式：允许游戏结束后悔棋
            if (!Game.freeModeEnabled && Game.gameOver) return;

            // AI模式下，非自由模式需要悔两步，检查是否有足够的步数
            if (Game.gameMode === 'ai' && !Game.freeModeEnabled && Game.moveHistory.length < 2) return;

            Timer.stop();

            if (Game.gameMode === 'ai') {
                // 自由模式：允许无限悔棋，包括AI的棋
                if (Game.freeModeEnabled) {
                    Game.undoMove();
                    // 确保悔棋后轮到人类玩家
                    if (Game.currentPlayer !== Game.humanPlayer) {
                        Game.undoMove();
                    }
                } else {
                    Game.undoMove();
                    Game.undoMove();
                }
            } else {
                Game.undoMove();
            }

            Game.gameOver = false;
            Game.hintCell = null;

            UI.updateStatus();
            UI.updateBoard();
            UI.updateControls();

            // 恢复计时器（不重置时间）
            Timer.resume();
        },

        showHint: function() {
            if (Game.replayMode) return;
            // 自由模式：允许游戏结束后使用提示
            if (!Game.freeModeEnabled && Game.gameOver) return;
            if (Game.gameMode !== 'ai') return;
            // 自由模式：任何时候都可以提示
            if (!Game.freeModeEnabled && Game.currentPlayer !== Game.humanPlayer) return;

            Game.hintCell = null;
            var config = DIFFICULTY_CONFIG[Game.aiDifficulty];
            var hintMove = AI.findBestMove(config.depth, 8, Game.moveHistory.length);
            Game.hintCell = hintMove;
            UI.updateBoard();
        },

        toggleSound: function() {
            Sound.toggle();
            UI.updateSoundButton();
        },

        toggleHistory: function() {
            var el = UI.els['history-list'];
            if (!el) return;
            var isVisible = el.style.display === 'block';
            UI.showHistory(!isVisible);
            if (!isVisible) {
                UI.updateHistoryList(History.load());
            }
        },

        clearHistory: function() {
            if (!confirm('确定要清空所有历史记录吗？')) return;
            History.clear();
            UI.updateHistoryList([]);
        }
    };

    // ========== 初始化 ==========
    document.addEventListener('DOMContentLoaded', function() {
        Controller.init();
    });

    window.Gomoku = {
        init: function() { Controller.init(); },
        start: function() { Controller.startGame(); },
        reset: function() { Controller.resetGame(); },
        undo: function() { Controller.undo(); },
        showHint: function() { Controller.showHint(); },
        toggleSound: function() { Controller.toggleSound(); },
        startReplay: function() { Replay.start(); },
        loadHistory: function(i) { Replay.loadGame(i); }
    };
})();
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
