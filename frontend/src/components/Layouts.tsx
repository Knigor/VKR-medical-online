import { Outlet, Link, useNavigate } from "react-router-dom";
import { ButtonProfile } from "./common/ButtonProfile";
import { useEffect, useState, useRef } from "react";
import { useAppDispatch, useAppSelector } from "../redux/hooks";
import { selectIsAuth, setIsAuth, resetIsAuth } from "../redux/userSlice";

function Layout() {
  const [isToggled, setIsToggled] = useState(false);
  const divLogout = useRef<HTMLDivElement>(null);
  const navigate = useNavigate();

  const dispatch = useAppDispatch();

  const isAuth = useAppSelector(selectIsAuth);

  const handleDocumentClick = (event: MouseEvent) => {
    if (
      divLogout.current &&
      !divLogout.current.contains(event.target as Node)
    ) {
      // Если клик произошел вне divLogout, закрываем меню
      setIsToggled(false);
    }
  };

  const handleLogout = () => {
    setIsToggled((prev) => !prev);
  };

  useEffect(() => {
    document.addEventListener("mousedown", handleDocumentClick);

    return () => {
      document.removeEventListener("mousedown", handleDocumentClick);
    };
  }, []);

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
            onClick={() => navigate("/")}
            className="cursor-pointer"
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
        {isAuth ? (
          <div className="flex flex-wrap gap-[6px] items-center">
            <div
              onClick={() => navigate("/profile")}
              className="group flex items-center gap-[6px] cursor-pointer "
            >
              <svg
                className="text-black group-hover:text-pink-400"
                width="36"
                height="36"
                viewBox="0 0 36 36"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  d="M24 15H27M24 21H27M9.255 22.5C9.56421 21.621 10.1387 20.8597 10.899 20.3211C11.6594 19.7826 12.5682 19.4933 13.5 19.4933C14.4318 19.4933 15.3406 19.7826 16.101 20.3211C16.8613 20.8597 17.4358 21.621 17.745 22.5M16.5 16.5C16.5 18.1569 15.1569 19.5 13.5 19.5C11.8431 19.5 10.5 18.1569 10.5 16.5C10.5 14.8431 11.8431 13.5 13.5 13.5C15.1569 13.5 16.5 14.8431 16.5 16.5ZM6 7.5H30C31.6569 7.5 33 8.84315 33 10.5V25.5C33 27.1569 31.6569 28.5 30 28.5H6C4.34315 28.5 3 27.1569 3 25.5V10.5C3 8.84315 4.34315 7.5 6 7.5Z"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                />
              </svg>
              <p className="group-hover:text-pink-400">Профиль</p>
            </div>
            <img
              className="cursor-pointer"
              onClick={handleLogout}
              src="../../public/profile.svg"
            ></img>
            {isToggled ? (
              <div
                ref={divLogout}
                className="flex flex-col items-start justify-center pl-[23px] w-[234px] h-[90px] right-[70px] top-[110px] shadow-lg absolute border bg-white border-gray-300 z-10"
              >
                <p
                  onClick={() => navigate("/profile")}
                  className="hover:text-pink-400 text-lg leading-7 font-normal cursor-pointer mb-[5px]"
                >
                  Игорь
                </p>
                <hr className="border border-gray-300 w-[187px] mb-[11px]"></hr>
                <p
                  onClick={() => dispatch(resetIsAuth())}
                  className="hover:text-pink-400 text-base leading-6 font-light cursor-pointer"
                >
                  Выйти
                </p>
              </div>
            ) : null}
          </div>
        ) : (
          <div>
            <ButtonProfile text="Войти" />
          </div>
        )}
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
