 < ? p h p 
 
 / / s e s s i o n _ s t a r t ( ) ; 
 
 / / u s e r   p r e s s e d   ' G e n e r a t e '   b u t t o n 
 
 i f   ( i s s e t ( $ _ P O S T [ ' G e n e r a t e ' ] ) ) 
 
 { 
 
 	 r e q u i r e ( ' c l a s s . P D F . p h p ' ) ; 
 
 	 
 
 	 / / c r e a t e   t h e   p d f 
 
 	 $ p d f   =   n e w   P D F ( ) ; 
 
 	 $ p d f - > i n i t ( ) ; 
 
 	 	 	 	 
 
 	 / / s e t   p r o p e r t i e s 
 
 	 $ p d f - > f i r s t n a m e _ c l i e n t   =   $ _ P O S T [ ' f i r s t n a m e _ c l i e n t ' ] ; 
 
 	 $ p d f - > l a s t n a m e _ c l i e n t   =     $ _ S E S S I O N [ ' l a s t _ n a m e ' ] ; 
 
 	 $ p d f - > z i p _ c l i e n t   =   $ _ P O S T [ ' z i p _ c l i e n t ' ] ; 
 
 	 $ p d f - > l o c a t i o n _ c l i e n t   =   $ _ P O S T [ ' l o c a t i o n _ c l i e n t ' ] ; 
 
 	 $ p d f - > f i r s t n a m e _ s e r v i c e   =   $ _ P O S T [ ' f i r s t n a m e _ s e r v i c e ' ] ; 
 
 	 $ p d f - > l a s t n a m e _ s e r v i c e   =   $ _ P O S T [ ' l a s t n a m e _ s e r v i c e ' ] ; 
 
 	 $ p d f - > z i p _ s e r v i c e   =   $ _ P O S T [ ' z i p _ s e r v i c e ' ] ; 
 
 	 $ p d f - > l o c a t i o n _ s e r v i c e   =   $ _ P O S T [ ' l o c a t i o n _ s e r v i c e ' ] ; 
 
 
 
 	 $ p d f - > p r i n t A l l ( ) ; 	 
 
 
 
 	 / / d i s p l a y   p d f   f i l e 
 
 	 $ f i l e   =   $ p d f - > O u t p u t ( " Q u i t t u n g . p d f " ,   " I " ) ; 	 
 
 } 
 
 
 
 ? > 
 
 < ! D O C T Y P E   h t m l   P U B L I C   " - / / W 3 C / / D T D   X H T M L   1 . 0   T r a n s i t i o n a l / / E N "   " h t t p : / / w w w . w 3 . o r g / T R / x h t m l 1 / D T D / x h t m l 1 - t r a n s i t i o n a l . d t d " > 
 
 < h t m l   x m l n s = " h t t p : / / w w w . w 3 . o r g / 1 9 9 9 / x h t m l " > 
 
 < h e a d > 
 
 < m e t a   h t t p - e q u i v = " C o n t e n t - T y p e "   c o n t e n t = " t e x t / h t m l ;   c h a r s e t = i s o - 8 8 5 9 - 1 "   / > 
 
 < t i t l e > F o r m   I n p u t < / t i t l e > 
 
 < s t y l e   t y p e = " t e x t / c s s " > 
 
 < ! - - 
 
 . s t y l e 1   { 
 
 	 f o n t - s i z e :   2 4 p x ; 
 
 	 f o n t - w e i g h t :   b o l d ; 
 
 } 
 
 - - > 
 
 < / s t y l e > 
 
 < / h e a d > 
 
 
 
 < b o d y > 
 
 < f o r m   n a m e = " p d f _ g e n e r a t o r "   m e t h o d = " P O S T "   a c t i o n = " < ? p h p   $ P H P _ S E L F   ? > " > 
 
 < t a b l e   w i d t h = " 5 0 % "   b o r d e r = " 0 " > 
 
     < c a p t i o n > & n b s p ; 
 
     < / c a p t i o n > 
 
     < t r > 
 
         < t h   w i d t h = " 3 9 % "   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > C l i e n t   F i r s t n a m e < / d i v > < / t h > 
 
         < t d   w i d t h = " 4 % " > : < / t d > 
 
         < t d   w i d t h = " 5 7 % " > < i n p u t   t y p e = " t e x t "   n a m e = " f i r s t n a m e _ c l i e n t "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > C l i e n t   L a s t n a m e   < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " l a s t n a m e _ c l i e n t "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > C l i e n t   Z i p   < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " z i p _ c l i e n t "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > C l i e n t   L o c a t i o n   < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " l o c a t i o n _ c l i e n t "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > S e r v i c e   F i r s t n a m e < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " f i r s t n a m e _ s e r v i c e "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " >   S e r v i c e   L a s t n a m e   < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " l a s t n a m e _ s e r v i c e "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > S e r v i c e   Z i p   < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " z i p _ s e r v i c e "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > S e r v i c e   L o c a t i o n   < / d i v > < / t h > 
 
         < t d > : < / t d > 
 
         < t d > < i n p u t   t y p e = " t e x t "   n a m e = " l o c a t i o n _ s e r v i c e "   / > < / t d > 
 
     < / t r > 
 
     < t r > 
 
         < t h   c o l s p a n = " 3 "   s c o p e = " r o w " > < d i v   a l i g n = " l e f t " > < / d i v > < / t h > 
 
     < / t r > 
 
 < / t a b l e > 
 
 < i n p u t   t y p e = " s u b m i t "   n a m e = " G e n e r a t e "   v a l u e = " G e n e r a t e "   / > 
 
 < / f o r m > 
 
 < / b o d y > 
 
 < / h t m l > 
 
