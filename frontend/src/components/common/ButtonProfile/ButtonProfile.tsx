import styles from "./ButtonProfile.module.css";
import { useAppDispatch } from "../../../redux/hooks";
import { setIsAuth } from "../../../redux/userSlice";

type ButtonProps = {
  text: string;
};

export const ButtonProfile: React.FC<ButtonProps> = ({ text }) => {
  const dispatch = useAppDispatch();

  return (
    <div>
      <button
        className={`${styles.buttonProfile} hover:bg-gray-300 decoration-gray-600 border-gray-300 `}
        type="button"
        onClick={() => (text === "Войти" ? dispatch(setIsAuth(true)) : null)}
      >
        {text}
      </button>
    </div>
  );
};
