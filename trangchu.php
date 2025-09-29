<?php include "head.php" ?>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
  <script src="https://unpkg.com/unlazy@0.11.3/dist/unlazy.with-hashing.iife.js" defer init></script>
  <script type="text/javascript">
    window.tailwind.config = {
      darkMode: ['class'],
      theme: {
        extend: {
          colors: {
            border: 'hsl(var(--border))',
            input: 'hsl(var(--input))',
            ring: 'hsl(var(--ring))',
            background: 'hsl(var(--background))',
            foreground: 'hsl(var(--foreground))',
            primary: {
              DEFAULT: 'hsl(var(--primary))',
              foreground: 'hsl(var(--primary-foreground))'
            },
            secondary: {
              DEFAULT: 'hsl(var(--secondary))',
              foreground: 'hsl(var(--secondary-foreground))'
            },
            destructive: {
              DEFAULT: 'hsl(var(--destructive))',
              foreground: 'hsl(var(--destructive-foreground))'
            },
            muted: {
              DEFAULT: 'hsl(var(--muted))',
              foreground: 'hsl(var(--muted-foreground))'
            },
            accent: {
              DEFAULT: 'hsl(var(--accent))',
              foreground: 'hsl(var(--accent-foreground))'
            },
            popover: {
              DEFAULT: 'hsl(var(--popover))',
              foreground: 'hsl(var(--popover-foreground))'
            },
            card: {
              DEFAULT: 'hsl(var(--card))',
              foreground: 'hsl(var(--card-foreground))'
            },
          },
        }
      }
    }
  </script>
  <style type="text/tailwindcss">
    @layer base {
				:root {
					--background: 0 0% 100%;
--foreground: 240 10% 3.9%;
--card: 0 0% 100%;
--card-foreground: 240 10% 3.9%;
--popover: 0 0% 100%;
--popover-foreground: 240 10% 3.9%;
--primary: 240 5.9% 10%;
--primary-foreground: 0 0% 98%;
--secondary: 240 4.8% 95.9%;
--secondary-foreground: 240 5.9% 10%;
--muted: 240 4.8% 95.9%;
--muted-foreground: 240 3.8% 46.1%;
--accent: 240 4.8% 95.9%;
--accent-foreground: 240 5.9% 10%;
--destructive: 0 84.2% 60.2%;
--destructive-foreground: 0 0% 98%;
--border: 240 5.9% 90%;
--input: 240 5.9% 90%;
--ring: 240 5.9% 10%;
--radius: 0.5rem;
				}
				.dark {
					--background: 240 10% 3.9%;
--foreground: 0 0% 98%;
--card: 240 10% 3.9%;
--card-foreground: 0 0% 98%;
--popover: 240 10% 3.9%;
--popover-foreground: 0 0% 98%;
--primary: 0 0% 98%;
--primary-foreground: 240 5.9% 10%;
--secondary: 240 3.7% 15.9%;
--secondary-foreground: 0 0% 98%;
--muted: 240 3.7% 15.9%;
--muted-foreground: 240 5% 64.9%;
--accent: 240 3.7% 15.9%;
--accent-foreground: 0 0% 98%;
--destructive: 0 62.8% 30.6%;
--destructive-foreground: 0 0% 98%;
--border: 240 3.7% 15.9%;
--input: 240 3.7% 15.9%;
--ring: 240 4.9% 83.9%;
				}
			}
       .small-img {
    width: 30%;        /* nhỏ hơn */
    max-width: 250px;  /* giới hạn max */
    height: auto;
  }
		</style>
</head>

<body>

  <body class="bg-background text-foreground">

    <section class="flex flex-col items-center justify-center h-[60vh] bg-cover"
      style="background-image:url('https://i.pinimg.com/originals/26/31/81/263181b4c7d8c0fb70aa6fa3f6c31936.jpg');">
      <h1 class="text-4xl font-bold text-white">Chúng tôi mang đến những sản phẩm gia dụng chất lượng cao nhất!</h1>
      <button onclick="window.location.href='sanpham.php'" class="mt-4 bg-primary text-primary-foreground p-2 rounded">Order Now</button>
    </section>

    <section class="p-8" style="background-color:#FDF5E6">
      <h2 class="text-3xl font-bold text-center">Thiết Kế Nội Thất Độc Quyền Của Chúng Tôi</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp01">
            <img src="https://i.pinimg.com/736x/79/a2/4f/79a24fa332c3db38b2ddddf0d08201c2.jpg" alt="Lungo Coffee" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Bàn làm việc chân sắt có hộc kéo (TS-VP39)</h3>
            <p>3.700.000 VNĐ</p><br>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp02">
            <img src="https://i.pinimg.com/474x/8d/b4/c7/8db4c70715d523587e252ac0c318b27e.jpg" alt="Dalgona Coffee" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Sofa đơn bọc nỉ (TS-SF11)</h3>
            <p>6.440.000 VNĐ</p><br>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp03">
            <img src="https://i.pinimg.com/474x/b0/5b/8e/b05b8edb178e3e95ec9d351687941f3a.jpg" alt="Iced Coffee" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Bàn IKEA 2m – Nhiều màu sắc (TS-VP32)</h3>
            <p>3.900.000 VNĐ</p><br>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp04">
            <img src="https://i.pinimg.com/474x/12/78/e6/1278e6bd0c0a76ae66d1d5b9b8f4d04d.jpg" alt="Filter Coffee" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Bộ Bàn Ăn Scania (Màu Tự Nhiên, Mặt Vân Đá, 140)</h3>
            <p>11.290.000 VNĐ</p>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
      </div>
      <h2 class="text-3xl font-bold text-center mt-8">Thiết Kế Nội Thất Đặc Biệt Của Chúng Tôi</h2>
      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp05">
            <img src="https://i.pinimg.com/736x/25/68/24/256824a0c3a8817c63d0d03e2e52666d.jpg" alt="Gulab Jamun" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Combo Giường Ngủ MOHO VLINE</h3>
            <p>16.190.000 VNĐ</p><br>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded " style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp06">
            <img src="https://i.pinimg.com/736x/5b/e1/29/5be1290e264c30a7abedc1fb1f7fa40a.jpg" alt="Chocolate Tiramisu" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Combo Phòng Khách MOHO VLINE Màu Tự Nhiên</h3>
            <p>17.890.000 VNĐ</p>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp07">
            <img src="https://i.pinimg.com/736x/aa/8b/65/aa8b655af2b0684b33ffa589fdfbffde.jpg" alt="Churros" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Tủ Quần Áo Gỗ Có Gương MOHO GRENAA 2 Nhiều Kích Thước</h3>
            <p>5.299.000 VNĐ</p>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
        <div class="border border-muted p-4 rounded" style="background-color:#EEDFCC">
          <a href="chitietsp.php?masp=sp08">
            <img src="https://i.pinimg.com/736x/53/28/ad/5328ad2cfa093ca802e5256cafd5ccd6.jpg" alt="Australian Lamingtons" class="w-full h-40 object-cover rounded" />
            <h3 class="font-semibold">Combo Sofa Gỗ Cao Su Chữ L MOHO HOBRO ( Màu nâu, 2m7)</h3>
            <p>18.990.000 VNĐ</p>
            <button class="bg-secondary text-secondary-foreground hover:bg-secondary/80 p-2 rounded" style="background-color:#CD853F">Đặt hàng</button>
          </a>
        </div>
      </div>
    </section>

    <section class="flex flex-col items-center p-8 bg-muted" style="background-color:#FFEFD5">
      <h2 class="text-2xl font-bold">Khám phá những thiết kế nội thất tinh tế nhất của chúng tôi</h2>
      <img src="https://i.pinimg.com/474x/e6/1b/e1/e61be1bc18225d2734d781948f05c1cb.jpg" alt="Coffee Beans" class="small-img mt-4" />
      <button onclick="window.location.href='sanpham.php'"
        class="mt-4 bg-primary text-primary-foreground p-2 rounded"
        style="background-color:#CD853F">
        Khám phá sản phẩm của chúng tôi
      </button>

    </section>

    <section class="p-8" style="background-color:#FDF5E6">
      <h2 class="text-3xl font-bold text-center">Những Khách Hàng Hạnh Phúc Của Chúng Tôi.</h2>
      <div class="space-y-4 mt-4">
        <div class="border border-muted p-4 rounded">
          <p>"I dropped by to have a cappuccino and honestly, other than the amazing taste, the service was just as spectacular! Great prices and excellent service!"</p>
          <p class="font-semibold">Jane Adams ★★★★★</p>
        </div>
        <div class="border border-muted p-4 rounded">
          <p>"I've been ordering beans from you for ten years. The quality of the product is consistently high! I'm grateful for the care that is apparently put into the roasts and the excellent customer service!"</p>
          <p class="font-semibold">Sam Williams ★★★★★</p>
        </div>
        <div class="border border-muted p-4 rounded">
          <p>"I've been ordering beans from you for years now. The quality of the product is fantastic and I always get the best cups of coffee!"</p>
          <p class="font-semibold">Angela Gonzalez ★★★★★</p>
        </div>
      </div>
    </section>

    <section class="flex flex-col items-center p-8 bg-muted" style="background-color:#FFEFD5">
      <h2 class="text-2xl font-bold">Tham gia ngay để nhận ưu đãi 15%!</h2>
      <p class="mt-2">Đăng ký nhận bản tin của chúng tôi để nhận mã giảm giá 15%!</p>
      <input type="email" placeholder="Email address" class="border border-muted p-2 rounded mt-4" />
      <button class="mt-2 bg-primary text-primary-foreground p-2 rounded" style="background-color: #CD853F">Subscribe</button>
    </section>

    <?php include 'boxchat.php'; ?>

    <!-- Icon chatbox nổi -->
    <style>
      #chatbox-toggle {
        position: fixed;
        bottom: 24px;
        right: 24px;
        z-index: 10000;
        background: #febf00;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        font-size: 32px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
      }

      .chat-container {
        position: fixed;
        bottom: 100px;
        right: 24px;
        z-index: 9999;
        display: none;
        /* Ẩn mặc định */
      }

      .chat-container.active {
        display: block;
      }
    </style>

    <button id="chatbox-toggle" title="Chat với chúng tôi" aria-label="Chat với chúng tôi">
      <img
        id="chatbox-icon"
        src="https://i.pinimg.com/236x/2f/08/ab/2f08ab311cb92ed2cfafc691b12a8ce2.jpg"
        alt="Chat Icon"
        style="width:56px; height:56px;border-radius: 50%;; pointer-events:none; transition: transform 0.3s cubic-bezier(.68,-0.55,.27,1.55); filter: drop-shadow(0 2px 6px rgba(0,0,0,0.15));" />
    </button>

    <script>
      const chatToggle = document.getElementById('chatbox-toggle');
      const chatBox = document.querySelector('.chat-container');
      const chatIcon = document.getElementById('chatbox-icon');

      chatToggle.onclick = function() {
        chatBox.classList.toggle('active');
        // Hiệu ứng động: lắc nhẹ icon khi nhấn
        chatIcon.style.transform = 'scale(1.2) rotate(-10deg)';
        setTimeout(() => {
          chatIcon.style.transform = 'scale(1) rotate(0deg)';
        }, 220);
      };
    </script>

    </footer>
  </body>

</body>

</html>