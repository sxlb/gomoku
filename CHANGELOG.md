# 更新日志

所有重要变更将记录在此文件中。

格式基于 [Keep a Changelog](https://keepachangelog.com/zh-CN/1.0.0/)，
本项目遵循 [语义化版本](https://semver.org/lang/zh-CN/) 规范。

---

## [3.0.0] — 2026-07-25

### ✨ 新增

- **禁手规则** — 实现专业五子棋禁手规则
  - 三三禁手：黑方一手棋同时形成两个或以上活三
  - 四四禁手：黑方一手棋同时形成两个或以上的四
  - 长连禁手：黑方形成六子或以上连珠
  - 禁手检测算法基于方向向量 + 连子计数 + 开口计数
  - 禁手警告 UI 动画（红色脉冲 + 文字提示）
- **自由模式** — 游戏结束后仍可悔棋和使用提示
  - 适合复盘研究棋局变化
  - AI 模式下悔棋始终回到人类回合
  - 提示按钮在游戏结束后仍可点击
- **限时赛模式** — 每方总时间 5 分钟
  - 总时间制，不随回合重置
  - 悔棋后不重置剩余时间
  - 超时直接判负
  - 时间显示格式 `分:秒`
- **键盘快捷键**
  - `H` 键触发提示
  - `U` 键触发悔棋
  - `R` 键重开游戏
- **模块化架构重构**
  - 将原本单一 IIFE 拆分为 11 个职责清晰的模块
  - 常量、工具、音效、AI、游戏状态、UI、历史、统计、计时器、回放、主控制器
  - 统一命名规范（公开方法驼峰、私有方法 `_` 前缀）

### 🐛 修复

- **AI 模式匹配完全失效** — 模式使用 `'player'` 占位符，但 lineStr 是 `'black'`/`'white'`，导致所有模式永远无法匹配。修复：归一化值后再匹配。
- **AI 难度配置不生效** — `_minimax` 中 `this.difficulty` 为 `undefined`，始终回退到 medium。修复：添加 `AI.difficulty` 属性和 `setDifficulty()` 方法。
- **限时赛悔棋重置总时间** — `undo()` 调用 `Timer.start()` 会重置 `totalTimerBlack/White`。修复：新增 `Timer.resume()` 方法，悔棋时恢复但不重置。
- **自由模式悔棋后回合卡住** — 悔一步后 currentPlayer 可能仍是 AI。修复：自由模式下若悔棋后不是人类回合，再悔一步。
- **超时判负结果记录错误** — `History.determineResult()` 不处理 timeout 情况。修复：添加 `timeoutLoser` 分支。
- **回放模式设置丢失** — 退出回放后 `freeModeEnabled`、`gameType`、`forbiddenEnabled` 丢失。修复：`_savedSettings` 补全所有字段。
- **游戏结束后无法悔棋** — `undo()` 在 `gameOver=true` 时直接返回。修复：自由模式允许游戏结束后悔棋。
- **AI 在非 AI 模式误落子** — `aiMove()` 缺少模式检查。修复：添加 `gameMode !== 'ai'` 守卫。
- **Timer 超时替人类落子** — 人类超时代码错误地调用了 AI 落子。修复：超时直接判负。
- **PvP 胜利无音效** — PvP 模式胜利时未播放音效。修复：添加 `Sound.play('win')`。
- **回放按钮游戏中可点击** — 游戏未结束时点击回放保存无效记录。修复：仅在游戏结束后启用。
- **Replay.start 保存 null 结果** — 回放时保存 null 结果。修复：添加 `gameOver` 检查。
- **Game.init 不清理 autoPlayInterval** — 重开游戏时自动播放定时器未清理。修复：添加清理。
- **showSettings 从回放进入时不保存设置** — 修复：添加恢复逻辑。
- **resetGame 在回放模式下不恢复设置** — 修复：添加恢复逻辑。
- **modeLabel 属性名错误** — 引用 `game.mode` 而非 `game.gameMode`。修复：统一属性名。

### ♻️ 优化

- **Replay 模块** — 提取 `_saveSettings()`、`_enterReplayMode()`、`_showReplayUI()` 三个私有方法，消除 `start()` 和 `loadGame()` 中的重复代码
- **Controller._handleGameEnd** — 提取 `_resolveResult()` 方法，统一 win 和 timeout 分支的结果计算逻辑
- **Timer 模块** — 提取 `_createInterval()` 方法，`start()` 和 `resume()` 共享 tick 逻辑
- **Controller.undo** — 简化分支结构，AI 模式下悔棋逻辑从嵌套 if-else 合并为单层判断
- **代码量** — 优化后减少约 4%

### 📝 文档

- 重写 README，新增架构图、模块清单、AI 算法说明、设置项表格
- 新增 CHANGELOG.md
- 添加版本徽章

---

## [2.0.0] — 早期版本

### 新增
- 游戏回放功能
- 战绩统计系统
- 多主题支持（4 种）
- 计时模式（每步 30s / 60s）
- AI 提示功能
- 响应式设计优化

---

## [1.0.0] — 初始版本

### 新增
- 基础五子棋功能
- 人机对战（简单 AI）
- 双人对战
- 悔棋功能
- 落子音效
