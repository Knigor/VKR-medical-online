import { Outlet, Link, useNavigate } from "react-router-dom";
import { ButtonSpec } from "../components/common/ButtonSpec";

const Profile = () => {
  return (
    <div className="flex flex-wrap justify-between">
      <div className="flex flex-col mt-[80px] ml-[88px]">
        <h1 className="text-3xl leading-9 font-bold ">Профиль</h1>
        <div className="flex flex-col gap-[34px] mt-[34px]">
          <div className="flex flex-wrap items-center">
            <hr className="border-[2px] border-solid mr-[4px] border-white w-[24px] h-[0px] rotate-90"></hr>
            {/* <hr className="border-[2px] border-solid mr-[4px] border-pink-400 w-[24px] h-[0px] rotate-90"></hr> */}
            <Link to="/profile">Мои врачи</Link>
          </div>

          <Link to="/profile/settings">Мой профиль</Link>
          <Link to="/profile/help">Помощь</Link>
        </div>
        <ButtonSpec text="Выбрать специалиста" />
      </div>
      <Outlet />
    </div>
  );
};

export default Profile;
