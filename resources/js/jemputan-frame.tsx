import { createRoot } from "react-dom/client";
import { BrowserRouter, Route, Routes } from "react-router-dom";
import { InvitationMusicProvider, WeddingInvitationFramePage } from "./wedding-frame";

const el = document.getElementById("jemputan-frame-app");
if (el) {
  createRoot(el).render(
    <BrowserRouter>
      <InvitationMusicProvider>
        <Routes>
          <Route path="*" element={<WeddingInvitationFramePage />} />
        </Routes>
      </InvitationMusicProvider>
    </BrowserRouter>,
  );
}
