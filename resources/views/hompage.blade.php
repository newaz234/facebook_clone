<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facebook - Clone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
         * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Helvetica, Arial, sans-serif;
        }
        body {
            background-color: #f0f2f5;
            color: #1c1e21;
            line-height: 1.34;
        }
        header {
            background-color: #ffffff;
            padding: 8px 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo-search {
            display: flex;
            align-items:center;
            gap: 10px;
            width:27%;
        }
        .logo {
            color: #1877f2;
            font-size: 40px;
        }
        .search-container {
            background: #f0f2f5;
            border-radius: 50px;
            padding: 8px 16px;
            display: flex;
            align-items: center;
        }
        .search-container i {
            color: #606770;
            margin-right: 8px;
        }
        .search-container input {
            background: transparent;
            border: none;
            outline: none;
            font-size: 14px;
            width:100%;
        }
        .nav-icons {
            display: flex;
           gap:15%;
            width:46%;
        }
        .nav-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: #444;
            font-size: 20px;
            cursor: pointer;
        }
        .nav-icon:hover {
            background: #f0f2f5;
        }
        .nav-icon.active {
            color: #1877f2;
            border-bottom: 3px solid #1877f2;
            border-radius: 0;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            cursor: pointer;
            width:27%;
            margin-left:20px;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
         /* Main Content Layout */
        .container {
            display: flex;
            margin-top: 60px;
            padding: 20px;
            gap: 20px;
        }
        /* Left Sidebar */
        .left-sidebar {
            width: 25%;
          position:fixed;
            height: calc(100vh - 80px);
            overflow-y: auto;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 8px 12px;
            border-radius: 8px;
            margin-bottom: 4px;
            cursor: pointer;
            color: #1c1e21;
            text-decoration: none;
        }
        .sidebar-link:hover {
            background: #f0f2f5;
        }
        .sidebar-link i {
            font-size: 20px;
            margin-right: 12px;
            width: 36px;
            text-align: center;
            color: #1877f2;
        }
        .sidebar-link img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 12px;
        }
        .divider {
            height: 1px;
            background: #dadde1;
            margin: 10px 0;
        }
        .sidebar-heading {
            padding: 12px 0 4px 12px;
            color: #65676b;
            font-size: 17px;
            font-weight: 600;
        }
         /* Main Content */
         .main-content {
            width:46%;
            margin-left: 27%;
            margin-right: 27%;
        }
        .stories-container {
            display: flex;
            gap: 8px;
            margin-bottom: 16px;
            overflow-x: auto;
            padding: 4px;
        }
        .story {
            width: 112px;
            height: 200px;
            border-radius: 10px;
            position: relative;
            flex-shrink: 0;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .story img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .story:hover img {
            transform: scale(1.05);
        }
        .story .story-avatar {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 4px solid #1877f2;
        }
        .story-username {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: white;
            font-weight: 600;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
        }
        .create-post {
            background: #ffffff;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }
        .post-input {
            display: flex;
            align-items: center;
            padding-bottom: 12px;
            border-bottom: 1px solid #e4e6eb;
        }
        .post-input img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 8px;
        }
        .post-input input {
            flex: 1;
            background: #f0f2f5;
            border: none;
            border-radius: 20px;
            padding: 10px 16px;
            outline: none;
            cursor: pointer;
        }
        .post-actions {
            display: flex;
            justify-content: space-around;
            padding-top: 8px;
        }
        .post-action {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
        }
        .post-action:hover {
            background: #f0f2f5;
        }
        .post-action i {
            margin-right: 4px;
            font-size: 20px;
        }
        .live-video i {
            color: #f3425f;
        }
        .photo-video i {
            color: #45bd62;
        }
        
        .feeling-activity i {
            color: #f7b928;
        }
        /* News Feed */
        .news-feed {
            background: #ffffff;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            margin-bottom: 16px;
        }
        .post-header {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        .post-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 8px;
        }
        .post-info h3 {
            font-size: 15px;
            margin-bottom: 2px;
        }
        .post-info span {
            font-size: 13px;
            color: #65676b;
        }
        .post-content {
            margin-bottom: 12px;
        }
        .post-content p {
            margin-bottom: 12px;
        }
        .post-content img {
            width: 100%;
            border-radius: 8px;
        }
        .post-stats {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e4e6eb;
            color: #65676b;
            font-size: 14px;
        }
        .post-buttons {
            display: flex;
            justify-content: space-around;
            padding: 4px 0;
        }
        .post-button {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            color: #65676b;
        }
        .post-button:hover {
            background: #f0f2f5;
        }
        .post-button i {
            margin-right: 8px;
            font-size: 18px;
        }
         /* Right Sidebar */
        .right-sidebar {
            width: 25%;
            position: fixed;
            margin-left:5px;
            right: 5px;
            height: calc(100vh - 80px);
            overflow-y: auto;
        }
        .sponsored {
            margin-bottom: 20px;
        }
        .sidebar-title {
            padding: 12px 0;
            color: #65676b;
            font-size: 17px;
            font-weight: 600;
        }
        .birthday-item {
            display: flex;
            align-items: center;
            margin-bottom: 12px;
        }
        .contact {
            display: flex;
            align-items: center;
            padding: 8px;
            border-radius: 8px;
            cursor: pointer;
        }
        .contact:hover {
            background: #f0f2f5;
        }
        .contact img{
            width: 36px;
            height: 36px;
            border-radius: 50%;
            margin-right: 12px;
            object-fit:over;
        }
        .online-status {
            position: relative;
        }
        .online-status::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background: #31a24c;
            border-radius: 50%;
            border: 2px solid #fff;
            bottom: 0;
            right: 10px;
        }
        @media (max-width: 1000px) {
            .search-container input {
                display: none;
            }
            .left-sidebar {
                display:none;
                width:0;
            }
            .right-sidebar {
               width:30%;
            }
            .main-content {
                width:65%;
                margin-right:35%;
                margin-left:0;
            }
        }
        @media (max-width: 700px) {
            .left-sidebar {
                display:none;
            }
            .right-sidebar {
              display:none;
            }
            .main-content {
                width:90%;
                margin-right:5%;
                margin-left:5%;
            }
            .nav-icons{
                display:none;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo-search">
            <div class="logo">
                <i class="fab fa-facebook"></i>
            </div>
            <div class="search-container">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Search Facebook">
            </div>
        </div>
        
        <div class="nav-icons">
            <div class="nav-icon active">
                <i class="fas fa-home"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-store"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-user-group"></i>
            </div>
            <div class="nav-icon">
                <i class="fas fa-gamepad"></i>
            </div>
        </div>
        
        <div class="user-profile">
            <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
            <span>John</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </header>
    
    <!-- Main Content -->
    <div class="container">
        <!-- Left Sidebar -->
        <div class="left-sidebar">
            <a href="#" class="sidebar-link">
                <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
                <span>John Doe</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-user-friends"></i>
                <span>Friends</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-users"></i>
                <span>Groups</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-store"></i>
                <span>Marketplace</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-video"></i>
                <span>Watch</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-history"></i>
                <span>Memories</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-bookmark"></i>
                <span>Saved</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-flag"></i>
                <span>Pages</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-calendar"></i>
                <span>Events</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-chevron-down"></i>
                <span>See more</span>
            </a>
            
            <div class="divider"></div>
            
            <div class="sidebar-heading">Your shortcuts</div>
            <a href="#" class="sidebar-link">
                <i class="fas fa-gamepad"></i>
                <span>Gaming</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-heart"></i>
                <span>Dating</span>
            </a>
            <a href="#" class="sidebar-link">
                <i class="fas fa-compass"></i>
                <span>Travel</span>
            </a>
        </div>
        
        <!-- Main Content -->
        <div class="main-content">
            <!-- Stories -->
            <div class="stories-container">
                <div class="story">
                    <img src="https://picsum.photos/id/100/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/men/1.jpg" alt="Avatar">
                    <div class="story-username">Your Story</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/101/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/women/2.jpg" alt="Avatar">
                    <div class="story-username">Sarah</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/102/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/men/3.jpg" alt="Avatar">
                    <div class="story-username">Mike</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/103/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/women/4.jpg" alt="Avatar">
                    <div class="story-username">Emma</div>
                </div>
                <div class="story">
                    <img src="https://picsum.photos/id/104/112/200" alt="Story">
                    <img class="story-avatar" src="https://randomuser.me/api/portraits/men/5.jpg" alt="Avatar">
                    <div class="story-username">Alex</div>
                </div>
            </div>
            
            <!-- Create Post -->
            <div class="create-post">
                <div class="post-input">
                    <img src="https://randomuser.me/api/portraits/men/1.jpg" alt="Profile">
                    <input type="text" placeholder="What's on your mind, John?">
                </div>
                <div class="post-actions">
                    <div class="post-action live-video">
                        <i class="fas fa-video"></i>
                        <span>Live video</span>
                    </div>
                    <div class="post-action photo-video">
                        <i class="fas fa-images"></i>
                        <span>Photo/video</span>
                    </div>
                    <div class="post-action feeling-activity">
                        <i class="fas fa-smile"></i>
                        <span>Feeling/activity</span>
                    </div>
                </div>
            </div>
            
            <!-- News Feed -->
            <div class="news-feed">
                <div class="post-header">
                    <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Profile">
                    <div class="post-info">
                        <h3>Sarah Johnson</h3>
                        <span>Yesterday at 3:45 PM · <i class="fas fa-globe-americas"></i></span>
                    </div>
                </div>
                <div class="post-content">
                    <p>Just visited the most amazing place! Nature is truly breathtaking 🌲🏔️</p>
                    <img src="https://picsum.photos/id/1018/600/400" alt="Post Image">
                </div>
                <div class="post-stats">
                    <div class="likes">
                        <i class="fas fa-thumbs-up"></i> 245
                    </div>
                    <div class="comments-shares">
                        45 comments · 12 shares
                    </div>
                </div>
                <div class="post-buttons">
                    <div class="post-button">
                        <i class="far fa-thumbs-up"></i>
                        <span>Like</span>
                    </div>
                    <div class="post-button">
                        <i class="far fa-comment"></i>
                        <span>Comment</span>
                    </div>
                    <div class="post-button">
                        <i class="fas fa-share"></i>
                        <span>Share</span>
                    </div>
                </div>
            </div>
            
            <div class="news-feed">
                <div class="post-header">
                    <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Profile">
                    <div class="post-info">
                        <h3>Mike Williams</h3>
                        <span>Today at 10:15 AM · <i class="fas fa-globe-americas"></i></span>
                    </div>
                </div>
                <div class="post-content">
                    <p>Just finished my morning run! Feeling energized and ready for the day 💪</p>
                </div>
                <div class="post-stats">
                    <div class="likes">
                        <i class="fas fa-thumbs-up"></i> 89
                    </div>
                    <div class="comments-shares">
                        23 comments · 5 shares
                    </div>
                </div>
                <div class="post-buttons">
                    <div class="post-button">
                        <i class="far fa-thumbs-up"></i>
                        <span>Like</span>
                    </div>
                    <div class="post-button">
                        <i class="far fa-comment"></i>
                        <span>Comment</span>
                    </div>
                    <div class="post-button">
                        <i class="fas fa-share"></i>
                        <span>Share</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="right-sidebar">
            <div class="sponsored">
                <div class="sidebar-title">Sponsored</div>
                <div class="sponsored-item">
                    <img src="#" alt="Ad">
                    <div>
                        <div>Summer Collection 2023</div>
                        <div>example.com</div>
                    </div>
                </div>
            </div>
            
            <div class="birthdays">
                <div class="sidebar-title">Birthdays</div>
                <div class="birthday-item">
                    <i class="fas fa-gift"></i>
                    <span><strong>Emma Thompson</strong> and <strong>2 others</strong> have birthdays today.</span>
                </div>
            </div>
            
            <div class="divider"></div>
            
            <div class="contacts">
                <div class="sidebar-title">Contacts</div>
                <div class="contact">
                    <div class="online-status">
                        <img src="https://randomuser.me/api/portraits/women/2.jpg" alt="Contact">
                    </div>
                    <span>Sarah Johnson</span>
                </div>
                <div class="contact">
                    <div class="online-status">
                        <img src="https://randomuser.me/api/portraits/men/3.jpg" alt="Contact">
                    </div>
                    <span>Mike Williams</span>
                </div>
                <div class="contact">
                    <div class="online-status">
                        <img src="https://randomuser.me/api/portraits/women/4.jpg" alt="Contact">
                    </div>
                    <span>Emma Thompson</span>
                </div>
                <div class="contact">
                    <img src="https://randomuser.me/api/portraits/men/5.jpg" alt="Contact">
                    <span>Alex Rodriguez</span>
                </div>
                <div class="contact">
                    <img src="https://randomuser.me/api/portraits/women/6.jpg" alt="Contact">
                    <span>Lisa Brown</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Simple interaction for demonstration
        document.querySelectorAll('.post-button').forEach(button => {
            button.addEventListener('click', function() {
                const action = this.querySelector('span').textContent;
                alert(`You clicked ${action}`);
            });
        });
        
        document.querySelector('.post-input input').addEventListener('click', function() {
            alert('Create a new post');
        });
        
        document.querySelectorAll('.story').forEach(story => {
            story.addEventListener('click', function() {
                const user = this.querySelector('.story-username').textContent;
                alert(`View ${user}'s story`);
            });
        });
    </script>
</body>
</html>