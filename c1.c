#include <netdb.h>
#include <netinet/in.h> 
#include <arpa/inet.h>
#include <unistd.h> 
#include <stdio.h> 
#include <stdlib.h> 
#include <string.h> 
#include <sys/socket.h> 
#define MAX 80 
#define PORT 8081
#define SA struct sockaddr 
void sign(int sockfd) 
{ 
	char buff[16]; 
	int m,y,n,z,x; 

		bzero(buff, sizeof(buff)); 
		printf("Enter the signature either 0 or 1:\n"); 
		n = 0; 
		
	        for(m=1;m<=5;m++)
                {
		   for(y=1;y<=3;y++)
		      {  do
                          {      
                            printf("cell(%d%d)-",m,y);
                            fflush(stdin);
                            scanf("%d",&z);
                             if(z == 1){
                               buff[n++] = '*';
                             }
                             else if(z == 0){
                             buff[n++] = ' ';
                             }
                             if(z>1||z<0)printf("Only 0 & 1 accepted\n");
                          }
                         while(z>1||z<0);
                      }
                }  
                buff[15] = '\0';
                for(x=0;x<15;)
                 { 
                  for(y=0;y<3;y++)
                  {
		   printf(" %c",buff[x]);
                   x++;
                  }
	           printf("\n");
                 }
                
                write(sockfd, buff, sizeof(buff)); 
 
	        read(sockfd, buff, sizeof(buff)); 
		 
} 

void Addmember(int sockfd){
 
    char buff[50];
    char buff2[255];
    char fun[50];
    char *ptr = NULL;
    char delim[] = " ";
 printf("          Welcome\n \
---------------------------------\n\
Addmember fname lname,YYYY-MM-DD,gender,recommender\n\
get_statement\n\
Check_status\n\
Search criteria\n\
exit\n\
---------------------------------\n");
   do{
      printf("Enter district code: ");
      scanf(" %s",buff);
      while((getchar()) != '\n');
      if(strlen(buff)>3||strlen(buff)<3){printf("\nDistrict code is STRICTLY three letters.\n");}
   }while(strlen(buff)>3||strlen(buff)<3);//
   write(sockfd, buff, sizeof(buff));
   read(sockfd, buff, sizeof(buff));
   
   do{
      printf("Enter Agent Name: ");
      fgets(buff,50,stdin);
      write(sockfd, buff, sizeof(buff));
      read(sockfd, buff, sizeof(buff));
      if(strcmp(buff,"wrong name") == 0){
         printf("Not valid User\n");
      }
   }while(strcmp(buff,"wrong name") == 0);
    
   do{
      printf("Type function: ");
      fgets(buff,50,stdin);
      write(sockfd, buff, sizeof(buff));
      int len = strlen(buff);
      if(buff[len-1] == '\n')
         buff[len-1] =0;
      strcpy(fun,buff);
      ptr = strtok(fun,delim);
      if(strcmp(fun,"Search")==0){
         printf("       Records     \n");
         read(sockfd, buff2, sizeof(buff2));
      printf("%s",buff2);
      }
      if(strcmp(buff,"Check_status")==0){
         read(sockfd, buff2, sizeof(buff2));
         printf("%s",buff2);
      }
   }while(strcmp(buff,"exit") != 0);
   sign(sockfd);  
}

int main() 
{ 
	int sockfd, connfd; 
	struct sockaddr_in servaddr, cli; 

	// socket create and varification 
	sockfd = socket(AF_INET, SOCK_STREAM, 0); 
	if (sockfd == -1) { 
		printf("socket creation failed...\n"); 
		exit(0); 
	} 
	else
		printf("Socket successfully created..\n"); 
	bzero(&servaddr, sizeof(servaddr)); 

	// assign IP, PORT 
	servaddr.sin_family = AF_INET; 
	servaddr.sin_addr.s_addr = inet_addr("127.0.0.1"); 
	servaddr.sin_port = htons(PORT); 

	// connect the client socket to server socket 
	if (connect(sockfd, (SA*)&servaddr, sizeof(servaddr)) != 0) { 
		printf("connection with the server failed...\n"); 
		exit(0); 
	} 
	else
		printf("connected to the server..\n"); 
        //function to addmember
        Addmember(sockfd);

	// close the socket 
	close(sockfd); 
} 

