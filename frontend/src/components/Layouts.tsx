import { Outlet, Link } from "react-router-dom";
import { ButtonProfile } from "./common/ButtonProfile";

function Layout() {
  return (
    <div className="flex flex-col min-h-screen">
      <header className="flex flex-wrap items-center justify-between h-[146px] ml-[68px] mr-[68px]">
        <div className="flex flex-wrap gap-[5px]">
          <svg
            width="40"
            height="40"
            viewBox="0 0 40 40"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M20 8.33333C22.5 5.83333 24.5666 5 27.5 5C29.9311 5 32.2627 5.96577 33.9818 7.68485C35.7009 9.40394 36.6666 11.7355 36.6666 14.1667C36.6666 17.9833 34.15 20.9 31.6666 23.3333L20 35L8.33331 23.3333C5.83331 20.9167 3.33331 18 3.33331 14.1667C3.33331 11.7355 4.29908 9.40394 6.01817 7.68485C7.73725 5.96577 10.0688 5 12.5 5C15.4333 5 17.5 5.83333 20 8.33333ZM20 8.33333L15.0666 13.2667C14.728 13.6028 14.4593 14.0027 14.2758 14.4432C14.0924 14.8837 13.998 15.3562 13.998 15.8333C13.998 16.3105 14.0924 16.7829 14.2758 17.2235C14.4593 17.664 14.728 18.0638 15.0666 18.4C16.4333 19.7667 18.6166 19.8167 20.0666 18.5167L23.5166 15.35C24.3814 14.5653 25.5073 14.1307 26.675 14.1307C27.8427 14.1307 28.9686 14.5653 29.8333 15.35L34.7666 19.7833M30 25L26.6666 21.6667M25 30L21.6666 26.6667"
              stroke="#F472B6"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
          </svg>
          <h1
            style={{
              fontFamily: "var(--font-family)",
              fontWeight: "600",
              fontSize: "30px",
              lineHeight: "120%",
              color: "#000",
            }}
          >
            Твоё здоровье
          </h1>
        </div>
        <div>
          <ButtonProfile text="Войти" />
        </div>
      </header>
      <hr className="max-sm:mt-[20px]"></hr>
      <main className="flex-grow">
        <Outlet />
      </main>
      <hr className="max-sm:mt-[20px]"></hr>
      <footer className="h-[100px] flex items-center justify-center ">
        <h1 className="text-gray-400 text-align-center">
          Выпусканая квалификационная работа для проведения врачебных
          консультаций в режиме онлайн
        </h1>
      </footer>
    </div>
  );
}

export default Layout;
